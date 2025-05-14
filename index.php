<?php

// Initialisation globale de l'application
require_once('vendor/autoload.php');
require_once __DIR__ . '/src/app.php';

use src\App;
use routes\Router;

$app = new App();
$app->init();
$router = new Router();


// Gestion du chemin des assets pour test local (sans -t public) ou production
if (php_sapi_name() === 'cli-server' && basename(__DIR__) !== 'public') {
    // Mode test local sans -t public
    define('ASSET_PATH', '/public/assets/');
} else {
    // Production ou test avec -t public
    define('ASSET_PATH', '/assets/');
}

define('VIEW_PATH','views'.DIRECTORY_SEPARATOR);

$router->register('/',['controllers\HomeControllers','home']);
$router->register('/index.php',['controllers\HomeControllers','home']);
try{
    $router->resolve($_SERVER['REQUEST_URI']);
}
catch (Exception $e){
    echo $e->getMessage();
}
