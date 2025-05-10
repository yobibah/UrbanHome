<?php 
namespace route;

class Router {
    private array $routes = [];

    public function register(string $path, callable|array $action): void {
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri) {
        $path = explode("?", $uri)[0];
        $action = $this->routes[$path] ?? null;

        if (!$action) {
            throw new \Exception("Route introuvable : $path");
        }

        if (is_callable($action)) {
            return $action();
        }

        if (is_array($action)) {
            list($classname, $method) = $action;

            if (class_exists($classname) && method_exists($classname, $method)) {
                $class = new $classname();
                return call_user_func_array([$class, $method], []);
            } else {
                throw new \Exception("Classe ou méthode introuvable : $classname::$method");
            }
        }

        throw new \Exception("Route introuvable ou mal définie : $path");
    }
}
