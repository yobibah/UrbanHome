<?php 
namespace model;

class Bailleur{
    private string $nom;
    private string $prenom;
    private string $email;  
    private string $mot_de_passe;
    private string $telephone;
    private string $adresse;
    private string $raison_social;


    public function __construct(string $nom, string $prenom,string $raison_social,string $adresse, string $email, string $telephone, string $mot_de_passe)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->raison_social = $raison_social;
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
    public function getAdresse(): string
    {
        return $this->adresse;
    }
    public function getRaisonSocial(): string
    {
        return $this->raison_social;
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
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }
    public function setRaisonSocial(string $raison_social)
    {
        $this->raison_social = $raison_social;
    }
    




}