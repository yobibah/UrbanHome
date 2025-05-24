<?php
// Point d'entrée principal (front controller)
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/App.php';

use src\App;
use routes\Router;
use controllers\HomeControllers;
use controllers\BailleurControllers;

App::init();
// Gestion du chemin des assets pour test local (sans -t public) ou production
if (php_sapi_name() === 'cli-server' && basename(__DIR__) !== 'public') {
    // Mode test local sans -t public
    define('ASSET_PATH', '/public/assets/');
} else {
    // Production ou test avec -t public
    define('ASSET_PATH', '/assets/');
}
// Pour la production, on utilise un chemin absolu sécurisé pour les vues
define('VIEW_PATH', realpath(__DIR__ . '/../views/') . DIRECTORY_SEPARATOR);

$router = new Router();
$router->register('/', ['controllers\HomeControllers', 'home']);
//$router->register('/index.php', ['controllers\HomeControllers', 'home']);
$router->register('/register', ['controllers\BailleurControllers', 'register']);
$router->register('/add', ['controllers\BailleurControllers', 'add']);
$router->register('/home-bailleur', ['controllers\BailleurControllers', 'login_Bailleur']);
$router->register('/Nouvelle-Propiete', ['controllers\BailleurControllers', 'NouvellePropiete']);
$router->register('/bailleur', ['controllers\HomeControllers', 'connexion_baileur']);
$router->register('/detail', ['controllers\HomeControllers', 'detail']);
$router->register('/Inscription', ['controllers\HomeControllers', 'connexion_bail']);
try {
    $router->resolve($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    echo $e->getMessage();
}
