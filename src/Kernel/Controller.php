<?php

namespace Core\Kernel;

use Core\Http\Request;
use Core\Http\Response;

abstract class Controller
{
    protected \PDO $db;

    public function __construct(protected Request $request, private string $basePath)
    {
        $this->db = Database::getInstance();
    }

    protected function render(string $view, array $data = [], string $layout = 'main'): Response
    {
        if (isset($_SESSION['redirect_data'])) {
            $data = array_merge($data, $_SESSION['redirect_data']);
            unset($_SESSION['redirect_data']);
        }

        ob_start();
        extract($data);
        $flash = $this->getFlash();
        require $this->basePath.'/resources/views/'.$view.'.php';
        $content = ob_get_clean();

        ob_start();
        require $this->basePath.'/resources/views/layouts/'.$layout.'.php';
        $content = ob_get_clean();

        return new Response($content);
    }

    protected function json(array $data): Response
    {
        $response = Response::json($data);
        return $response;
    }

    protected function redirect(string $url, array $data = []): Response
    {
        if (!empty($data)) {
            $_SESSION['redirect_data'] = $data;
        }
        $response = Response::redirect($url);
        return $response;
    }

    protected function getFlash(): ?array
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    /**
    * @param "default"|"success"|"error"|"info"|"warn" $type
    * @param string $message
    */
    protected function setFlash(string $type = "default", string $message = ""): void
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }
}
