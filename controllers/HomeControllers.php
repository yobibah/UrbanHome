<?php 
namespace controllers;
require_once('vendor/autoload.php');

use model\Users;
use model\UsersBDD;
use model\ArticleBDD;
use model\CommentaireBDD;
use Soap\Url;
use model\Like_articleBDD;

class HomeControllers {
    public function index() {
        require_once 'public/index.php';
    }
}