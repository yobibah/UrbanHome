<?php 
namespace model;

abstract class  Users {
    private string $nom;
    private string $prenom;
    private string $email;
    private $password;
    private $numero_telephone;
    private $raison_social_;
    private $adresse;


    public function __construct(string $nom, string $prenom, string $email, string $password, $numero_telephone, $username, $adresse)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->numero_telephone = $numero_telephone;
        $this->raison_social_ = $username;
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
        return $this->password;
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
        $this->password = $password;
    }
    public function setNumero_telephone($numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;
    }
  
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

     abstract public function getusername():string;
      abstract public function setUsername(string $username):string;
}