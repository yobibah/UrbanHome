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
            $this->render('public/propriete/detail', ['proprietes' => $proprietes]);
        }
        else{
            $this->render('error/404');
        }
    }
     public function connexion_baileur() {
          if (isset($_SESSION['id'])) {
        $this->render('bailleur/accueil');
        return;
    }
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
public function listes_prorpietes_home() {
    // 1. Récupération de la page actuelle depuis les paramètres GET
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

    // 2. Définition du nombre d'éléments par page
    $limit = 6;
    $offset = ($page - 1) * $limit;

    // 3. Instanciation du modèle
    $propriete = new ProprieteBDD();

    // 4. Nombre total de propriétés "libres"
    $total_props = $propriete->countProprietesLibres();

    // 5. Calcul du nombre total de pages (en tenant compte du reste)
    $total_pages = ceil($total_props / $limit);

    // 6. Récupération des propriétés paginées
    $proprietes = $propriete->getAlldataforpropriete($limit, $offset);

    // 7. Affichage de la vue avec les données ou message d'erreur
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