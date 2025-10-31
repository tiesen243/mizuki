<?php

namespace Core;

use Core\Http\{Request,Response};
use Core\Kernel\{Container,Database,Router};

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
        require_once $this->basePath.'/app/routes.php';

        $this->request = new Request($_GET, $_POST, $_SERVER);
        $routes = Router::getRoutes();

        $method = $this->request->method();
        $uri = parse_url($this->request->uri(), PHP_URL_PATH);
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = rtrim($uri, '/');
        }

        if (isset($routes[$method][$uri])) {
            $response = $this->dispatch($routes[$method][$uri]);
        } else {
            foreach ($routes[$method] as $routePattern => $handler) {
                $pattern = preg_replace('#:([\w]+)#', '(?P<$1>[^/]+)', $routePattern);
                $pattern = '#^' . $pattern . '$#';
                if (preg_match($pattern, $uri, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $response = $this->dispatch($handler, $params);
                };
            }
        }

        if (!$response instanceof Response) {
            $response = new Response($response) ;
        }
        $this->setCorsHeaders();
        $response->send();
    }

    private function dispatch(callable|array $handler, array $params = []): Response
    {
        $response = Response::json(['message' => 'Not Found'], 404);

        if (is_callable($handler)) {
            $response = call_user_func($handler, $this->request, ...array_values($params));
        } elseif (is_array($handler) && count($handler) === 2) {
            if (!is_subclass_of($handler[0], \Core\Abstract\Controller::class)) {
                $response = Response::json(['message' => 'Controller Not Found'], 404);
            } else {
                $controller = $this->container->make($handler[0], [
                    'request' => $this->request,
                    'basePath' => $this->basePath
                ]);

                if (!method_exists($controller, $handler[1])) {
                    $response = Response::json(['message' => 'Method Not Found'], 404);
                } else {
                    $response = $this->container->call($controller, $handler[1], $params);
                }
            }
        }
        return $response;
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

    private function setCorsHeaders(): void
    {
        $corsConfig = $this->config['cors'] ?? [];
        $allowedOrigins = $corsConfig['allowed_origins'] ?? [];
        $allowedMethods = $corsConfig['allowed_methods'] ?? [];
        $allowedHeaders = $corsConfig['allowed_headers'] ?? [];
        $allowCredentials = $corsConfig['allow_credentials'] ?? false;

        header('Access-Control-Allow-Origin: ' . implode(',', $allowedOrigins));
        header('Access-Control-Allow-Methods: ' . implode(',', $allowedMethods));
        header('Access-Control-Allow-Headers: ' . implode(',', $allowedHeaders));
        if ($allowCredentials) {
            header('Access-Control-Allow-Credentials: true');
        }
    }
}
