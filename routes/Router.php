<?php 
namespace routes;

use controllers\HomeControllers;

class Router {
    private array $routes = [
        '/' => ['controllers\HomeControllers', 'home'],
        '/home' => ['controllers\HomeControllers', 'home'],
        '/index.php' => ['controllers\HomeControllers', 'home'],

        //public routes
        '/public/about' => ['controllers\HomeControllers', 'about'],
        '/public/contact' => ['controllers\HomeControllers', 'contact'],
        '/public/search' => ['controllers\HomeControllers', 'search'],
        '/public/search/result' => ['controllers\HomeControllers', 'searchResult'],

        //propriete routes
        '/propriete/liste' => ['controllers\HomeControllers', 'listes_proprietes_home'],
        '/propriete/detail' => ['controllers\HomeControllers', 'detail'],

        //bailleur routes
        '/bailleur' => ['controllers\BailleurControllers','login_bailleur'],
        '/bailleur/inscription' => ['controllers\BailleurControllers', 'register'],
        '/bailleur/logout' => ['controllers\BailleurControllers', 'logout'],
        '/bailleur/dashboard' => ['controllers\BailleurControllers', 'dashboard'],
        '/bailleur/biens' => ['controllers\BailleurControllers', 'listBiens'],
        '/bailleur/contrats' => ['controllers\BailleurControllers', 'listContrats'],
        '/bailleur/paiements' => ['controllers\BailleurControllers', 'listPaiements'],
        '/bailleur/messages' => ['controllers\BailleurControllers', 'listMessages'],

        //client routes
        '/client/dashboard' => ['controllers\ClientControllers', 'dashboard'],
        '/client/locations' => ['controllers\ClientControllers', 'listLocations'],
        '/client/paiements' => ['controllers\ClientControllers', 'listPaiements'],
        '/client/messages' => ['controllers\ClientControllers', 'listMessages'],

        //manager routes
        '/manager/dashboard' => ['controllers\ManagerControllers', 'dashboard'],
        '/manager/clients' => ['controllers\ManagerControllers', 'listClients'],
        '/manager/biens' => ['controllers\ManagerControllers', 'listBiens'],
        '/manager/contrats' => ['controllers\ManagerControllers', 'listContrats'],
        '/manager/paiements' => ['controllers\ManagerControllers', 'listPaiements'],
        '/manager/messages' => ['controllers\ManagerControllers', 'listMessages'],
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