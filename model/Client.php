<?php
namespace model;

use Yobib\UrbanHome\Database;

class Client {
    public $id;
    public $nom;
    public $prenom;
    public $identifiant;
    public $mot_de_passe;
    public $adresse;
    public $email;
    public $telephone;

    public function __construct($id = null, $nom = '', $prenom = '', $identifiant = '', $mot_de_passe = '', $adresse = '', $email = '', $telephone = '') {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->identifiant = $identifiant;
        $this->mot_de_passe = $mot_de_passe;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    // Exemple de méthode d'enregistrement
    public static function enregistrer($data) {
        // À compléter : insérer $data dans la base de données
    }

    // Exemple de méthode de connexion
    public static function connecter($identifiant, $mot_de_passe) {
        // À compléter : vérifier les identifiants dans la base de données
    }
}
