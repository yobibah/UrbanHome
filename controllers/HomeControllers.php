<?php 
namespace controllers;

class HomeControllers extends Controllers{
    public function home() {
        $this->render('public/home');
    }
    public function about() {
        $this->render('public/about');
    }
    public function contact() {
        $this->render('public/contact');
    }
    public function error404() {
        $this->render('error/404');
    }
}