<?php 
namespace model;

class Agent{
    private string $nom;
    private string $prenom;
    private  $email;  
    private string $telephone;
    private string $mot_de_passe;
    

    public function __construct(string $nom, string $prenom, string $telephone, string $mot_de_passe)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
   
        $this->telephone = $telephone;
        $this->mot_de_passe = $mot_de_passe;
    }
    public function getNom(): string
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
    public function getTelephone(): string
    {
        return $this->telephone;
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
    public function setPassword(string $mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }
}