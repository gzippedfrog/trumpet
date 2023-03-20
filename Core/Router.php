<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => "controllers/$controller.php",
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
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

    public function abort($code = 404, $message = 'Page not found')
    {
        http_response_code($code);

        view('error', compact('code', 'message'));

        exit();
    }
}
