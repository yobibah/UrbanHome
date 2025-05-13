<?php
namespace controllers;

use Yobib\UrbanHome\Database;

class ClientControllers {
    // Affiche le formulaire d'inscription
    public function register() {
        require __DIR__ . '/../views/client/register.php';
    }

    // Traite l'inscription
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'identifiant' => $_POST['identifiant'] ?? '',
                'mot_de_passe' => password_hash($_POST['mot_de_passe'] ?? '', PASSWORD_DEFAULT),
                'adresse' => $_POST['adresse'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telephone' => $_POST['telephone'] ?? ''
            ];
            // Enregistrement du client (à compléter avec la base de données)
            // Client::enregistrer($data);
            // Redirection vers la page de connexion ou dashboard
            header('Location: /client/login');
            exit();
        } else {
            header('Location: /client/register');
            exit();
        }
    }

    // Affiche le formulaire de connexion
    public function login() {
        require __DIR__ . '/../views/client/login.php';
    }

    // Traite la connexion
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifiant = $_POST['identifiant'] ?? '';
            $mot_de_passe = $_POST['mot_de_passe'] ?? '';
            // Recherche du client (à compléter avec la base de données)
            // $client = Client::connecter($identifiant, $mot_de_passe);
            // Exemple simplifié :
            if ($identifiant === 'demo' && $mot_de_passe === 'demo') {
                session_start();
                $_SESSION['client'] = $identifiant;
                header('Location: /client/dashboard');
                exit();
            } else {
                echo '<p style="color:red;">Identifiants invalides</p>';
                require __DIR__ . '/../views/client/login.php';
            }
        } else {
            header('Location: /client/login');
            exit();
        }
    }

    // Tableau de bord client
    public function dashboard() {
        session_start();
        if (!isset($_SESSION['client'])) {
            header('Location: /client/login');
            exit();
        }
        $client = $_SESSION['client'];
        require __DIR__ . '/../views/client/dashboard.php';
    }
    // Déconnexion du client
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /client/login');
        exit();
    }

    // Affiche les propriétés disponibles
    public function properties() {
        require __DIR__ . '/../views/client/properties.php';
    }

    // Affiche les favoris
    public function favorites() {
        // recupere le id du client fais une recherche des id du client qui sont 
        // dans la table favorites
        require __DIR__ . '/../views/client/favorites.php';
    }

    // Prendre rendez-vous
    public function appointment() {
        require __DIR__ . '/../views/client/appointment.php';
    }
}
