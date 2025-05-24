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
              $_SESSION['msg']  = "Cet email est déjà utilisé.";
            
            $this->render('bailleur/auth/inscription', ['error' =>   $_SESSION['msg'] ]);
            return;
        }

        // Vérification des mots de passe
        if ($mot_de_passe !== $mot_de_passe2) {
              $_SESSION['msg']  = "Les mots de passe ne correspondent pas.";
            $this->render('bailleur/auth/inscription', ['error' =>   $_SESSION['msg'] ]);
            return;
        }

        // Hachage du mot de passe
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_BCRYPT);
        $bailleur = new Bailleur($nom, $prenom, $raison_social, $adresse, $email, $telephone, $mot_de_passe_hache);
        $bail=$bailleurBDD->insertBailleur($bailleur);
        if (!$bail) {
              $_SESSION['msg']  = "Erreur lors de l'inscription. Veuillez réessayer.";
            $this->render('bailleur/auth/inscription', ['error' => $_SESSION['msg'] ]);
            return;
        }
        else{
            $_SESSION['msg'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";

            $this->render('bailleur/auth/connexion', ['success' =>   $_SESSION['msg'] ]);
            return;
        }
       
       
    } else {
        $this->render('public/home');
    }
}

// functiomn pour recuperer les donnes du bailleur et se connecter
public function login_Bailleur()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars(trim($_POST['email']));
        $mot_de_passe = htmlspecialchars(trim($_POST['mot_de_passe']));

        $bailleurBDD = new BailleurBDD();
        $bailleurs = $bailleurBDD->loginBailleur($email,$mot_de_passe);
        if($bailleurs){
            $_SESSION['msg']='connexion reussie ';
        
            $_SESSION['nom'] = $bailleurs['objet']->getNom();
            $_SESSION['prenom'] = $bailleurs['objet']->getPrenom();
            $_SESSION['email'] = $bailleurs['objet']->getEmail();
            $_SESSION['telephone'] = $bailleurs['objet']->getTelephone();
            $_SESSION['adresse'] = $bailleurs['objet']->getAdresse();
            $_SESSION['raison_social'] = $bailleurs['objet']->getRaisonSocial();
            $_SESSION['id'] = $bailleurs['id'];
            $this->render('bailleur/accueil');
            exit();
        }
        else{
            $_SESSION['msg']='email ou mot de passe incorrect';
            $this->render('bailleur/auth/connexion', ['error' => $_SESSION['msg'] ]);
            return;
        }

    }
}

// controler pour creer de nouvelles insertions de proprietes

public function NouvellePropiete(){
    $typepropiete = new TypepropieteBDD();
    $types = $typepropiete->getTypepropiete();
    $this->render('bailleur/propriete/add', ['types' => $types]);


    }
// CONTROLLER

public function add() {
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
        function uploadImage($file, $uploadDir) {
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
        $date_ajout=date("Y-m-d");

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
            $this->render('bailleur/propriete/detail');
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


public function insererProprietes(){
 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $opt = htmlspecialchars(trim($_POST['opt']));
        $description = htmlspecialchars(trim($_POST['description']));
        $adresse = htmlspecialchars(trim($_POST['adresse']));
        $prix = htmlspecialchars(trim($_POST['prix']));
        $type = htmlspecialchars(trim($_POST['type']));
        $etat = htmlspecialchars(trim(string: $_POST['etat']));
        $image1= htmlspecialchars(trim($_POST['im1']));
        $image2 = htmlspecialchars(trim($_POST['im2']));
        $image3 = htmlspecialchars(trim($_POST['im3']));
        $id_bailleur = $_SESSION['id'];
         $date_ajout=date("Y-m-d H:i:s");
        $propriete = new Propriete($type, $etat, $opt,$adresse, $prix,$image1,$image2 ,$image3,$description,$id_bailleur,$date_ajout);
        $proprieteBDD = new ProprieteBDD();
        if($proprieteBDD->insertPropriete($propriete)){
            $_SESSION['msg'] = "Propriété ajoutée avec succès.";
            $this->render('bailleur/mes_proprietes');
            exit();
        }else{
            $_SESSION['msg'] = "Erreur lors de l'ajout de la propriété.";
            $this->render('bailleur/ajouter_propriete');
            exit();
        }
    }
    else{
        $this->render('bailleur/ajouter_propriete');
    }
}

//controller pour affciher les proprietes du bailleur
public function mes_propietes(){
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $limit =10;
        $ofset=0;
        $proprieteB = new ProprieteBDD();
        $proprietes= $proprieteB->getProprieteByBailleurId($id,$limit,$ofset);
    if($proprietes){   
        $this->render('bailleur/mes_proprietes');
    }

    }
    else{
        $_SESSION['msg']= 'pas de proprietes disposnibles pour ce bailleur ';
        $this->render('bailleur/mes_proprietes');
    }

    
    


}

// controller pour afficher les details d'une propriete

public function voir_propriete($id){

}

public function supprimer_propriete($id){
}


public function modifier_propriete($id,Propriete $propriete){

}
}