<?php 
namespace controllers;

class HomeControllers extends Controllers{
    public function home() {
        require_once VIEW_PATH . 'public/home.php';
    }
}