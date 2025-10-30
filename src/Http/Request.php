<?php

namespace Core\Http;

class Request
{
    private array $get;
    private array $post;
    private array $server;

    public function __construct(array $get = [], array $post = [], array $server = [])
    {
        $this->get = !empty($get) ? $get : $_GET;
        $this->post = !empty($post) ? $post : $_POST;
        $this->server = !empty($server) ? $server : $_SERVER;
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function getQuery(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function getPost(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }
}
