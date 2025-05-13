<?php
// Point d'entrée principal (front controller)
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/App.php';

use src\App;
use routes\Router;

App::init();

//define('VIEW_PATH', __DIR__ . '/../views/');

$router = new Router();
$router->register('/', ['controllers\HomeControllers', 'home']);
$router->register('/index.php', ['controllers\HomeControllers', 'home']);

try {
    $router->resolve($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    echo $e->getMessage();
}
