<?php 
namespace routes;

use controllers\HomeControllers;

class Router {
    private array $routes = [
        '/' => ['controllers\HomeControllers', 'home'],
        '/index.php' => ['controllers\HomeControllers', 'home'],
        '/public/about' => ['controllers\HomeControllers', 'about'],
        '/public/contact' => ['controllers\HomeControllers', 'contact'],
        '/public/propriete/liste' => ['controllers\HomeControllers', 'listes_prorpietes_home'],
        '/public/propriete/detail' => ['controllers\HomeControllers', 'detail'],
        '/bailleur' => ['controllers\HomeControllers', 'connexion_baileur'],
        '/inscription' => ['controllers\HomeControllers', 'connexion_bail'],
        '/connexion' => ['controllers\HomeControllers', 'connexion_bail'],
    ];

    public function register(string $path, callable|array $action): void {
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri) {
        $path = explode("?", $uri)[0];
        $action = $this->routes[$path] ?? null;

        if (!$action) {
            $home = new HomeControllers();
            $home->error404();
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