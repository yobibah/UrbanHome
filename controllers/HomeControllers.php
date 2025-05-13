<?php 
namespace controllers;
require_once('vendor/autoload.php');

class HomeControllers {
    public function home() {
        require_once 'views/home/home.php';
    }
}