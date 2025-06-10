<?php

namespace controllers;

use model\Bailleur;
use model\BailleurBDD;
use model\Manager;
use model\Propriete;
use model\ProprieteBDD;
use model\TypepropieteBDD;
use controllers\HomeControllers;

class BailleurControllers extends Controllers
{
    public function register()
    {
        //session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupération et sécurisation des données
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $email = htmlspecialchars(trim($_POST['email']));
            $mot_de_passe = htmlspecialchars(trim($_POST['mot_de_passe']));
            $mot_de_passe2 = htmlspecialchars(trim($_POST['confirm_mot_de_passe']));
            $telephone = htmlspecialchars(trim($_POST['telephone']));
            $adresse = htmlspecialchars(trim($_POST['adresse']));
            $raison_social = htmlspecialchars(trim($_POST['raison_social']));

            $bailleurBDD = new BailleurBDD();

            // Vérifier si l'email existe déjà
            if ($bailleurBDD->getBailleurByEmail($email)) {
                $_SESSION['msg'] = "Cet email est déjà utilisé.";

                $this->render('bailleur/auth/inscription', ['error' => $_SESSION['msg']]);
                return;
            }

            // Vérification des mots de passe
            if ($mot_de_passe !== $mot_de_passe2) {
                $_SESSION['msg'] = "Les mots de passe ne correspondent pas.";
                $this->render('bailleur/auth/inscription', ['error' => $_SESSION['msg']]);
                return;
            }

            // Hachage du mot de passe
            $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_BCRYPT);
            $bailleur = new Bailleur($nom, $prenom, $raison_social, $adresse, $email, $telephone, $mot_de_passe_hache);
            $bail = $bailleurBDD->insertBailleur($bailleur);
            if (!$bail) {
                $_SESSION['msg'] = "Erreur lors de l'inscription. Veuillez réessayer.";
                $this->render('bailleur/auth/inscription', ['error' => $_SESSION['msg']]);
                return;
            } else {
                $_SESSION['msg'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";

                $this->render('bailleur/auth/connexion', ['success' => $_SESSION['msg']]);
                return;
            }


        } else {
            $this->render('public/home');
        }
    }
    
public function home()
{
    if (isset($_SESSION['id'])) {

        $bailleurpropr = new ProprieteBDD();
        // ENVOYER la variable à la vue
             $nbreProprietes = $bailleurpropr->getNbProprieteByBailleurID($_SESSION['id']);
                $_SESSION['nbreProprietes'] = $nbreProprietes;
                $nb_ventes=$bailleurpropr->nbProprietesVendu($_SESSION['id']);
                
                $this->render('bailleur/accueil', ['success' => $_SESSION['msg'], 'nbreProprietes' => $nbreProprietes,'nb_ventes'=>$nb_ventes]);
                   
        //$this->render('bailleur/accueil');
        return;
    } else {
        $this->render('bailleur/auth/connexion');
    }
}



    // functiomn pour recuperer les donnes du bailleur et se connecter
    public function login_Bailleur()
    {
        // Si l'utilisateur est déjà connecté, on redirige vers l'accueil bailleur
        if (isset($_SESSION['id'])) {
            $bailleurpropr = new ProprieteBDD();
                $nbreProprietes = $bailleurpropr->getNbProprieteByBailleurID($_SESSION['id']);
                $_SESSION['nbreProprietes'] = $nbreProprietes;
               $this->render('bailleur/accueil', ['success' => $_SESSION['msg'], 'nbreProprietes' => $nbreProprietes]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $mot_de_passe = htmlspecialchars(trim($_POST['mot_de_passe']));

            $bailleurBDD = new BailleurBDD();
           $bailleurpropr = new ProprieteBDD();
            $bailleurs = $bailleurBDD->loginBailleur($email, $mot_de_passe);
            if ($bailleurs) {
                $_SESSION['msg'] = 'connexion reussie ';

                $_SESSION['nom'] = $bailleurs['objet']->getNom();
                $_SESSION['prenom'] = $bailleurs['objet']->getPrenom();
                $_SESSION['email'] = $bailleurs['objet']->getEmail();
                $_SESSION['telephone'] = $bailleurs['objet']->getTelephone();
                $_SESSION['adresse'] = $bailleurs['objet']->getAdresse();
                $_SESSION['raison_social'] = $bailleurs['objet']->getRaisonSocial();
                $_SESSION['id'] = $bailleurs['id'];
                 $id_bailleur = $_SESSION['id'];
                $nbreProprietes = $bailleurpropr->getNbProprieteByBailleurID($id_bailleur);
                $_SESSION['nbreProprietes'] = $nbreProprietes;
               
                $nb_ventes=$bailleurpropr->nbProprietesVendu($id_bailleur);
                 $_SESSION['nb_ventes']= $nb_ventes;
                $this->render('bailleur/accueil', ['success' => $_SESSION['msg'], 
                'nbreProprietes' => $nbreProprietes,
                'nb_ventes'=>$nb_ventes]);
                exit();


            } else {
                $_SESSION['msg'] = 'email ou mot de passe incorrect';
                $this->render('bailleur/auth/connexion', ['error' => $_SESSION['msg']]);
                return;
            }
        } else {
            // Si ce n'est pas une requête POST (ex : accès direct à la page), afficher le formulaire
            $this->render('bailleur/auth/connexion');
        }
    }


    // controler pour creer de nouvelles insertions de proprietes

    public function NouvellePropiete()
    {
        $typepropiete = new TypepropieteBDD();
        $types = $typepropiete->getTypepropiete();
        $this->render('bailleur/propriete/add', ['types' => $types]);


    }
    // CONTROLLER

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $description = htmlspecialchars(trim($_POST['description']));
            $adresse = htmlspecialchars(trim($_POST['adresse']));
            $prix = htmlspecialchars(trim($_POST['prix']));
            $id_type = htmlspecialchars(trim($_POST['type']));
            $opt = htmlspecialchars(trim($_POST['opt']));
            $etat = "libre";
            $id_bailleur = $_SESSION['id'];

            // Chemin absolu vers le dossier public/assets/images/
            $uploadDir = realpath('assets/images');
            if (!$uploadDir) {
                $_SESSION['msg'] = "Erreur : le dossier d'images n'existe pas.";
                $this->render('bailleur/propriete/add');
                exit();
            }

            $uploadDir = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            // Fonction d'upload d'image sans condition
            function uploadImage($file, $uploadDir)
            {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $fileName = $file['name'];
                    $fileTmp = $file['tmp_name'];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $uniqueName = uniqid('img_', true) . '.' . $fileExt;
                    $destination = $uploadDir . $uniqueName;

                    if (move_uploaded_file($fileTmp, $destination)) {
                        return $uniqueName;
                    }
                }
                return null;
            }

            // Upload des images (im1 obligatoire, les autres facultatives)
            $image1 = uploadImage($_FILES['im1'], $uploadDir);
            $image2 = uploadImage($_FILES['im2'], $uploadDir);
            $image3 = uploadImage($_FILES['im3'], $uploadDir);

            if (!$image1) {
                $_SESSION['msg'] = "Erreur : L'image principale est obligatoire.";
                $this->render('bailleur/propriete/add');
                exit();
            }
            $date_ajout = date("Y-m-d");

            $propriete = new Propriete(
                $id_type,
                $etat,
                $opt,
                $adresse,
                $prix,
                $image1,
                $image2,
                $image3,
                $description,
                $id_bailleur,
                $date_ajout

            );

            $proprieteBDD = new ProprieteBDD();
            if ($proprieteBDD->insertPropriete($propriete)) {
                $_SESSION['msg'] = "Propriété ajoutée avec succès.";
                    $nbreProprietes = $proprieteBDD->getNbProprieteByBailleurID($id_bailleur);
                    $nb_ventes= $proprieteBDD->nbProprietesVendu($id_bailleur);
                   $_SESSION['nbreProprietes'] = $nbreProprietes;
                $this->render('bailleur/accueil', ['success' => $_SESSION['msg'], 'nbreProprietes' => $nbreProprietes,'nb_ventes'=>$nb_ventes]);
            } else {
                $_SESSION['msg'] = "Erreur lors de l'ajout de la propriété.";
                $this->render('bailleur/propriete/add');
            }
            exit();
        } else {
            $_SESSION['msg'] = "Erreur : requête invalide.";
            $this->render('bailleur/propriete/add');
        }
    }



    //controller pour affciher les proprietes du bailleur
public function mes_propietes()
{
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $limit = 6;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $proprieteBDD = new ProprieteBDD();
        $total_props = $proprieteBDD->getNbProprieteByBailleurId($id);
        $total_pages = ceil($total_props / $limit);

        $proprietes = $proprieteBDD->getProprieteByBailleurId($id, $limit, $offset);
        $nb_ventes= $proprieteBDD->nbProprietesVendu($id);
                  
        $this->render('bailleur/propriete/list', [
            'proprietes' => $proprietes,
            'total_pages' => $total_pages,
            'current_page' => $page,
            'nb_ventes' => $nb_ventes,
        ]);
    } else {
        $_SESSION['msg'] = 'Vous devez être connecté pour voir vos propriétés.';
        $this->render('bailleur/auth/connexion', ['error' => $_SESSION['msg']]);
    }





    }
    public function profile(){
       if(isset($_GET['id'])){
        $id=base64_decode($_GET['id']);
        $bailleur= new BailleurBDD();
        $bail= $bailleur->getBailleurById($id);
        if($bail){
            $this->render('bailleur/profile/vue',['bail'=>$bail]);
        }
       
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
    // controller pour afficher les details d'une propriete



    public function supprimer_propriete()
    {
        $id = base64_decode($_GET['id']);
        $proprieteBDD = new ProprieteBDD();
        
        if ($proprieteBDD->deletePropriete($id)){
            $_SESSION['supp'] = "Propriété supprimée avec succès.";
            $nbreProprietes = $proprieteBDD->getNbProprieteByBailleurID($_SESSION['id']);
            $nb_ventes= $proprieteBDD->nbProprietesVendu($_SESSION['id']);
            $_SESSION['nbreProprietes'] = $nbreProprietes;
            $this->render('bailleur/accueil', ['success' => $_SESSION['msg'], 'nbreProprietes' => $nbreProprietes,'nb_ventes'=>$nb_ventes]);
        } else {
            $_SESSION['msg'] = "Erreur lors de la suppression de la propriété.";
            $this->render('bailleur/propriete/list', ['error' => $_SESSION['msg']]);
        }
        
       
    }



    public function modifier_propriete()
    {
        if($_GET['id']){
        $id = base64_decode($_GET['id']);
        $proprieteBDD = new ProprieteBDD();
        
        $propriete = $proprieteBDD->getProprieteById($id);
        $typepropiete = new TypepropieteBDD();
        $types = $typepropiete->getTypepropiete();


        if ($propriete) {
            
            $this->render('bailleur/propriete/edit', ['propriete' => $propriete,'types' => $types]);
        } else {
            $_SESSION['error_modif'] = "Propriété non trouvée.";
            $this->render('bailleur/propriete/list', ['error' => $_SESSION['msg']]);
        }
    
        }
        else{
            $_SESSION['error_modif'] = "ID de propriété invalide.";
            $this->render('bailleur/propriete/list', ['error' => $_SESSION['msg']]);
        }

    }

        public function update_propriete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $description = htmlspecialchars(trim($_POST['description']));
            $adresse = htmlspecialchars(trim($_POST['adresse']));
            $prix = htmlspecialchars(trim($_POST['prix']));
            $id_type = htmlspecialchars(trim($_POST['type']));
            $opt = htmlspecialchars(trim($_POST['opt']));
            $etat = "libre";
            $id_bailleur = $_SESSION['id'];
            $id_propriete = $_SESSION['id_prop'];

            // Chemin absolu vers le dossier public/assets/images/
            $uploadDir = realpath('assets/images');
            if (!$uploadDir) {
                $_SESSION['error_modif'] = "Erreur : le dossier d'images n'existe pas.";
                $this->render('bailleur/propriete/add');
                exit();
            }

            $uploadDir = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            // Fonction d'upload d'image sans condition
            function uploadImage($file, $uploadDir)
            {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $fileName = $file['name'];
                    $fileTmp = $file['tmp_name'];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $uniqueName = uniqid('img_', true) . '.' . $fileExt;
                    $destination = $uploadDir . $uniqueName;

                    if (move_uploaded_file($fileTmp, $destination)) {
                        return $uniqueName;
                    }
                }
                return null;
            }

             $images = new ProprieteBDD();
            // Upload des images (im1 obligatoire, les autres facultatives)
            
          $image1 = uploadImage($_FILES['im1'], $uploadDir) ?? $images->getimagesById($id_propriete)['image1'];
         $image2 = uploadImage($_FILES['im2'], $uploadDir) ?? $images->getimagesById($id_propriete)['image2'];
          $image3 = uploadImage($_FILES['im3'], $uploadDir) ?? $images->getimagesById($id_propriete)['image3'] ;

    
            /*
            if(!isset($image1) ){
               
                $files= $images->getimagesById($id_propriete)['image1'];
                $image1 = uploadImage($files, $uploadDir);
            }
            if(!isset($image2) ){
                $files= $images->getimagesById($id_propriete)['image2'];
                $image2 = uploadImage($files, $uploadDir);
            }
            if(!isset($image3) ){
                $files= $images->getimagesById($id_propriete)['image3'];
                $image3 = uploadImage($files, $uploadDir);
            }
            */
            if (!$image1) {
                $_SESSION['error_modif'] = "Erreur : L'image principale est obligatoire.";
                $this->render('bailleur/propriete/add');
                exit();
            }
            $date_ajout = date("Y-m-d");

            $propriete = new Propriete(
                $id_type,
                $etat,
                $opt,
                $adresse,
                $prix,
                $image1,
                $image2,
                $image3,
                $description,
                $id_bailleur,
                $date_ajout

            );

            $proprieteBDD = new ProprieteBDD();
            if ($proprieteBDD->UpdateProprieteById($id_propriete,$propriete)) {
                $_SESSION['success_maj'] = "Propriéte mise a jour avec succès.";
                    $nbreProprietes = $proprieteBDD->getNbProprieteByBailleurID($id_bailleur);
                    $nb_ventes= $proprieteBDD->nbProprietesVendu($id_bailleur);
                   $_SESSION['nbreProprietes'] = $nbreProprietes;
                $this->render('bailleur/accueil', ['success' => $_SESSION['success_maj'], 'nbreProprietes' => $nbreProprietes,'nb_ventes'=>$nb_ventes]);
            } else {
                $_SESSION['msg'] = "Erreur lors de l'ajout de la propriété.";
                $this->render('bailleur/propriete/add');
            }
            exit();
        } else {
            $_SESSION['msg'] = "Erreur : requête invalide.";
            $this->render('bailleur/propriete/add');
        }
    }
    public function mes_rdv(){
        if(isset($_SESSION['id'])){
            $rdv = new BailleurBDD();
        }
    }


 
    public function logout()
    {

        unset($_SESSION['id']);
      header('Location: /');


        exit();

    }
}