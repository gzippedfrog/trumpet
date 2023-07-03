<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Router
{
    protected array $routes = [];

    public function add(string $method, string $uri, string $controller): self
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => "Http/controllers/$controller.php",
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function get(string $uri, string $controller): self
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): self
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete(string $uri, string $controller): self
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch(string $uri, string $controller): self
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function only(string $key): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /** @return mixed|void */
    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if ($route['middleware'] === 'guest') {
                    Guest::handle();
                }

                if ($route['middleware'] === 'auth') {
                    Auth::handle();
                }

                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    public function abort(int $code = Response::NOT_FOUND, string $message = 'Page not found'): never
    {
        http_response_code($code);

        view('error', compact('code', 'message'));

        exit();
    }

    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }
}
