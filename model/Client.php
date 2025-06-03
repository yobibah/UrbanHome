<?php
namespace model;
use model\Users;
use config\Config;
Class Client  {

    private string $nom;
    private string $prenom;
    private string $email;
    private $mot_de_passe;
    private $numero_telephone;
    private $id_agent;
    private $adresse;


    public function __construct(string $nom, string $prenom, $adresse ,string $email, $numero_telephone, $mot_de_passe,$id_agent)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->numero_telephone = $numero_telephone;
        $this->id_agent = $id_agent;
        $this->adresse = $adresse;
       
    }

     public  function getNom(): string
    {
        return $this->nom;
    }
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->mot_de_passe;
    }
    public function getNumero_telephone()
    {
        return $this->numero_telephone;
    }
  
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setPassword(string $password)
    {
        $this->mot_de_passe = $password;
    }
    public function setNumero_telephone($numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;
    }
  
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    public function setId_agent($id_agent)
    {
        $this->id_agent = $id_agent;
    }
    public function getId_agent()
    {
        return $this->id_agent;
    }

 

}

//test sur limplementation de la classe Clientz
