<?php


namespace controllers;

use controllers\Controllers;
use model\Client;
use model\clientBDD;
use model\Agent;
use model\AgentBDD;
use model\ProprieteBDD;
use model\Propriete;


class ClientControllers extends Controllers
{

    public function NouveauClient()
    {
             if (isset($_SESSION['id_client'])) {
            // Si l'utilisateur est déjà connecté, redirige vers la page d'accueil
            header("Location: /client/accueil");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $nom = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $email = htmlspecialchars(trim($_POST['email']));
            $telephone = htmlspecialchars(trim($_POST['telephone']));
            $motDePasse = htmlspecialchars(trim($_POST['mot_de_passe']));
            $confirmMotDePasse = htmlspecialchars(trim($_POST['mot_de_passe2']));
            $adresse = htmlspecialchars(trim($_POST['adresse']));

            $agentBDD = new AgentBDD();
            $agent = $agentBDD->agent_not_affected();

            if (!empty($agent)) {
                $id_agent = $agent[0]['id'];
            } else {
                $_SESSION['error'] = "Aucun agent disponible pour l'affectation.";
                header("Location: /inscription-client");
                exit;
            }

            if ($motDePasse !== $confirmMotDePasse) {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                header("Location: /inscription-client");
                exit;
            }

            $mdp = password_hash($motDePasse, PASSWORD_DEFAULT);

            // Ajuste ici l'ordre et nombre d'arguments selon ton constructeur Client
            $client = new Client($nom, $prenom, $adresse, $email, $telephone, $mdp, $id_agent);

            $clientBDD = new ClientBDD();

            if ($clientBDD->insertClient($client)) {
                $_SESSION['success'] = "Client ajouté avec succès.";
                $this->render('client/auth/connexion', ['success' => $_SESSION['success']]);
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout du client.";
                header("Location: /inscription-client");
                exit;
            }
        }
    }



    public function LoginClient()

    {
       if (isset($_SESSION['id_client'])) {
    // Si l'utilisateur est déjà connecté, récupérer les données pour affichage
    $proprieteB = new ProprieteBDD();
    $bannieres = $proprieteB->getBannieresAccueil();
    $limit = 3;
    $ofset = 0;
    $proprietes = $proprieteB->getAlldataforpropriete($limit, $ofset);

    $this->render("client/accueil", [
        'bannieres' => $bannieres ?? [],
        'proprietes' => $proprietes ?? [],
    ]);
    exit;
}


        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $telephone = htmlspecialchars(trim($_POST['tel']));
            $motDePasse = htmlspecialchars(trim($_POST['mdp']));

            $clientBDD = new ClientBDD();
            $client = $clientBDD->LoginClient($telephone, $motDePasse);
             $proprieteB = new ProprieteBDD();
                $bannieres = $proprieteB->getBannieresAccueil(); 
                $limit = 3;
                $ofset = 0;
                $proprietes = $proprieteB->getAlldataforpropriete($limit, $ofset);

            if ($client) {
                $_SESSION['id_client'] = $client['id'];
                $_SESSION['nom_client'] = $client['objet']->getNom();
                $_SESSION['prenom_client'] = $client['objet']->getPrenom();
                $_SESSION['telephone_client'] = $client['objet']->getNumero_telephone();
                $_SESSION['email_client'] = $client['objet']->getEmail();
                $_SESSION['adresse_client'] = $client['objet']->getAdresse();
               
               // ou autre classe dédiée aux bannières
        
             
                    $this->render('client/accueil', ['proprietes' => $proprietes, 'bannieres' => $bannieres,]);

                
                
                exit;
            } else {
             
                $this->render('client/auth/connexion', ['error' => "Mot de passe incorrect."]);
            }
        } else { 
              
            $this->render('client/auth/connexion', ['error' => "Aucun client trouvé avec ce numéro de téléphone."]);
        }



    }


}