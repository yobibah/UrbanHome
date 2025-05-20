<?php 
namespace controllers;

class HomeControllers extends Controllers{
    public function home() {
        $this->render('auth/connexion');
    }
     public function connexion_baileur() {
        $this->render('bailleur/auth/connexion');
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