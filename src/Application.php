<?php

namespace Core;

use Core\Container;
use Core\Http\Request;
use Core\Http\Response;

class Application
{
    protected Container $container;
    protected Request $request;
    private string $basePath;
    private array $config;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '/');
        $this->container = new Container();
        $this->request = new Request($_GET, $_POST, $_SERVER);
    }

    public function run(): void
    {
        $this->loadEnv();
        $this->config = getConfig();

        Database::connect(
            $this->config['database']['host'],
            $this->config['database']['name'],
            $this->config['database']['user'],
            $this->config['database']['password']
        );
        $this->registerProviders();

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

    private function registerProviders(): void
    {
        $providersPath = $this->basePath.'/app/Provider';
        $providerFiles = glob($providersPath.'/*.php');

        foreach ($providerFiles as $file) {
            $className = pathinfo($file, PATHINFO_FILENAME);
            $fullClass = "App\\Provider\\{$className}";

            if (class_exists($fullClass) && is_subclass_of($fullClass, 'Core\Abtract\Provider')) {
                $fullClass::register($this->container);
            }
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
