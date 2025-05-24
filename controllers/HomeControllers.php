<?php 
namespace controllers;
use model\Propriete;
use model\ProprieteBDD;
class HomeControllers extends Controllers{
    public function home() {
        $proprietes = new ProprieteBDD();
        $limit = 3;
        $ofset = 0;
        $proprietes = $proprietes->getAlldataforpropriete($limit,$ofset);
        $bannieres = new ProprieteBDD(); // ou autre classe dédiée aux bannières
       $bannieres = $bannieres->getBannieresAccueil(); 
        if($proprietes){
            $this->render('public/home', ['proprietes' => $proprietes, 'bannieres' => $bannieres]);

        }
        else{
            $this->render('error/404');
        }
        
    }
    public function detail() {
        $propriete = new ProprieteBDD();
        $id = $_GET['id'];
        $id = base64_decode($id);
        $proprietes = $propriete->getProprieteById($id);
        if($proprietes){
            $this->render('bailleur/propriete/detail', ['proprietes' => $proprietes]);
        }
        else{
            $this->render('error/404');
        }
    }
     public function connexion_baileur() {
        $this->render('bailleur/auth/connexion');
    }
    public function connexion_bail() {
        $this->render('bailleur/auth/inscription');
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