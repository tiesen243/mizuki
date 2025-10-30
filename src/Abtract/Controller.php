<?php

namespace Core\Abtract;

use Core\Http\Request;
use Core\Http\Response;

abstract class Controller
{
    public function __construct(protected Request $request, private string $basePath)
    {
    }

    protected function render(string $view, array $data = [], string $layout = 'main'): Response
    {
        ob_start();
        extract($data);
        require $this->basePath . '/views/' . $view . '.php';
        $content = ob_get_clean();

        ob_start();
        require $this->basePath . '/views/layouts/' . $layout . '.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    protected function json(array $data): Response
    {
        $response = Response::json($data);
        return $response;
    }

    protected function redirect(string $url): Response
    {
        $response = Response::redirect($url);
        return $response;
    }
}
