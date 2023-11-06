<?php

namespace App\Libraries;

use Exception;

class Router
{
    protected static $routes = [];

    public static function get(string $uri, string $controller, string $method): void
    {
        self::$routes[Url::prettyUri($uri)] = [
            'uri' => Url::prettyUri($uri),
            'controller' => $controller,
            'method' => $method,
            'requestMethod' => 'GET'
        ];
    }

    public static function post(string $uri, string $controller, string $method): void
    {
        self::$routes[Url::prettyUri($uri)] = [
            'uri' => Url::prettyUri($uri),
            'controller' => $controller,
            'method' => $method,
            'requestMethod' => 'POST'
        ];
    }

    public static function dispatch() : void
    {
        try {
            $routes = self::$routes;
            $routeFound = false;

            foreach ($routes as $uri => $route) {
                if (Url::requestUri() === $uri) {
                    $routeFound = true;
                    echo self::handleRoute($route);
                    break;
                }
            }
    
            if (!$routeFound) {
                echo 'Page not found';
                die();
            }
        } catch(Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    protected static function handleRoute(array $route): string|null
    {
        extract($route);

        if ($_SERVER['REQUEST_METHOD'] !== $requestMethod) {
            throw new Exception('405 method not allowed!');
        }
 
        if (Url::requestUri() !== $uri) {
            throw new Exception('404 not found!');
        }

        if (!class_exists($controller)) {
            throw new Exception("Controller class {$controller} not found!");
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $method)) {
            throw new Exception("Method {$method} not found in {$controller}!");
        }

        return $controllerInstance->{$method}();
    }
}
