<?php

namespace Core\Kernel;

use Core\Http\Request;
use Core\Http\Response;

class Application
{
    private string $basePath;
    private array $config;

    protected Container $container;
    protected Request $request;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '/');

        $this->loadEnv();
        $this->config = getConfig();
        Database::connect($this->config['database']);
    }

    public function register(callable $callback): self
    {
        $this->container = new Container();
        call_user_func($callback, $this->container);
        return $this;
    }

    public function run(): void
    {
        $this->request = new Request($_GET, $_POST, $_SERVER);

        $controllerParam = $this->request->getQuery('controller', 'home');
        $actionParam = $this->request->getQuery('action', 'index');

        $controllerName = ucfirst(strtolower($controllerParam)) . 'Controller';
        $controllerClass = "App\\Controller\\{$controllerName}";

        try {
            if (!class_exists($controllerClass)) {
                throw new \Exception("Controller {$controllerName} not found.");
            }

            $controller = $this->container->make($controllerClass, [
                'request' => $this->request,
                'basePath' => $this->basePath
            ]);

            if (!method_exists($controller, $actionParam)) {
                throw new \Exception("Action {$actionParam} not found in controller {$controllerName}.");
            }

            $response = $this->container->call($controller, $actionParam);
            if ($response instanceof Response) {
                $response->send();
            } else {
                echo $response;
            }
        } catch (\Throwable $e) {
            $response = new Response('Internal Server Error: ' . $e->getMessage(), 500);
            $response->send();
        }
    }

    public function cli(callable $callback): void
    {
        $this->request = new Request([], [], $_SERVER);

        try {
            call_user_func($callback, $this->request, Database::getInstance());
        } catch (\Throwable $e) {
            echo 'Error: ' . $e->getMessage() . PHP_EOL;
        }
    }

    private function loadEnv(string $envPath = '.env'): void
    {
        $envFile = $this->basePath.DIRECTORY_SEPARATOR.$envPath;
        if (!file_exists($envFile)) {
            return;
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, "\"'");
            if (!getenv($key)) {
                putenv("{$key}={$value}");
            }
        }
    }
}
