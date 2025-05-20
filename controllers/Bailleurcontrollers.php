<?php 

namespace controllers;

use model\Bailleur;
use model\BailleurBDD;
use model\Manager;
use model\Propriete;
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
            
            $this->render('bailleur/auth/connexion', ['error' =>   $_SESSION['msg'] ]);
            return;
        }

        // Vérification des mots de passe
        if ($mot_de_passe !== $mot_de_passe2) {
              $_SESSION['msg']  = "Les mots de passe ne correspondent pas.";
            $this->render('bailleur/auth/connexion', ['error' =>   $_SESSION['msg'] ]);
            return;
        }

        // Hachage du mot de passe
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_BCRYPT);
        $bailleur = new Bailleur($nom, $prenom, $raison_social, $adresse, $email, $telephone, $mot_de_passe_hache);
        $bail=$bailleurBDD->insertBailleur($bailleur);
        if (!$bail) {
              $_SESSION['msg']  = "Erreur lors de l'inscription. Veuillez réessayer.";
            $this->render('bailleur/auth/connexion', ['error' => $_SESSION['msg'] ]);
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

public function connexion()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars(trim($_POST['email']));
        $mot_de_passe = htmlspecialchars(trim($_POST['mot_de_passe']));

        $bailleurBDD = new BailleurBDD();
        $bailleurs = $bailleurBDD->loginBailleur($email,$mot_de_passe);
        if($bailleurs){
            $_SESSION['msg']='connexion reussie ';
            $this->render('Location: bailleur/dashboard');
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

}

//controller pour affciher les proprietes du bailleur
public function mes_propietes(){

}

// controller pour afficher les details d'une propriete

public function voir_propriete($id){

}

public function supprimer_propriete($id){
}


public function modifier_propriete($id,Propriete $propriete){

}
}