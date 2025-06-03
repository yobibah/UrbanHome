<?php 
namespace controllers;
use model\Propriete;
use model\ProprieteBDD;
class HomeControllers extends Controllers{
    public function home() {
              /*if (isset($_SESSION['id'])) {
        $this->render('bailleur/accueil');
        return;
    }
        */
        $proprietes = new ProprieteBDD();
        $ProprieteBDD = new ProprieteBDD();
        $limit = 3;
        $ofset = 0;
        $proprietes = $proprietes->getAlldataforpropriete($limit,$ofset);
        $bannieres = new ProprieteBDD(); // ou autre classe dédiée aux bannières
       $bannieres = $bannieres->getBannieresAccueil(); 
           
           $nb_ventes = $ProprieteBDD->nbProprietesVendu($_SESSION['id']);
                $_SESSION['nb_ventes'] = $nb_ventes;
        if($proprietes){
            $this->render('public/home', ['proprietes' => $proprietes, 'bannieres' => $bannieres,'nb_ventes'=>$nb_ventes]);

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
            $this->render('public/propriete/detail', ['proprietes' => $proprietes]);
        }
        else{
            $this->render('error/404');
        }
    }
     public function connexion_baileur() {
          if (isset($_SESSION['id'])) {
              $proprieteBDD = new ProprieteBDD();
              $nb_ventes= $proprieteBDD->nbProprietesVendu($_SESSION['id']);
    
                    $nbreProprietes = $proprieteBDD->getNbProprieteByBailleurID($_SESSION['id']);
                $_SESSION['nbreProprietes'] = $nbreProprietes;
                $this->render('bailleur/accueil', ['success' => $_SESSION['msg'], 'nbreProprietes' => $nbreProprietes,'nb_ventes'=>$nb_ventes]);
             // $this->render('bailleur/accueil');
        return;
    }
        $this->render('bailleur/auth/connexion');

    }
    public function connexion_client() {
        if (isset($_SESSION['id_client'])) {
             $proprietes = new ProprieteBDD();
        $ProprieteBDD = new ProprieteBDD();
        $limit = 3;
        $ofset = 0;
        $proprietes = $proprietes->getAlldataforpropriete($limit,$ofset);
        $bannieres = new ProprieteBDD(); // ou autre classe dédiée aux bannières
       $bannieres = $bannieres->getBannieresAccueil(); 
           
           $nb_ventes = $ProprieteBDD->nbProprietesVendu($_SESSION['id']);
                $_SESSION['nb_ventes'] = $nb_ventes;
        if($proprietes){
            $this->render('client/accueil', ['proprietes' => $proprietes, 'bannieres' => $bannieres,'nb_ventes'=>$nb_ventes]);
            exit;

        }
        }
        else{
            $this->render('client/auth/connexion');
            exit;

        }
       
    }
    
    public function inscription_client() {
        if (isset($_SESSION['id_client'])) {
            $this->render('client/accueil');
            return;
        }
        $this->render('client/auth/inscription');
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
public function listes_prorpietes_home() {

    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $limit = 6;
    $offset = ($page - 1) * $limit;
    $propriete = new ProprieteBDD();
    $total_props = $propriete->countProprietesLibres();
    $total_pages = ceil($total_props / $limit);
    $proprietes = $propriete->getAlldataforpropriete($limit, ofset: $offset);

  
    if ($proprietes && is_array($proprietes)) {
        $this->render('public/propriete/list', [
            'proprietes' => $proprietes,
            'page' => $page,
            'total_pages' => $total_pages
        ]);
    } else {
        $this->render('error/404');
    }
}

    public function error404() {
        $this->render('error/404');
    }
}