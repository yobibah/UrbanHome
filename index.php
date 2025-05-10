<?php 
require_once('vendor/autoload.php');
require_once 'controllers/HomeControllers.php';
require_once 'controllers/ArticleControllers.php';
require_once 'controllers/LikeControllers.php';
use route\Router;
use controllers\ArticleControllers;
use controllers\CommentairesControllers;
use controllers\LikeControllers;

$router = new Router();
define('VIEW_PATH','views'.DIRECTORY_SEPARATOR);

$router->register('/',['controllers\HomeControllers','home']);


try{
    $router->resolve($_SERVER['REQUEST_URI']);

}
catch (Exception $e){
    echo $e->getMessage();
}
