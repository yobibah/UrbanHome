<?php

namespace model;

class Client
{
    private string $nom;
    private string $prenom;
    private $email;
    private $pass;
    private $date_naissance;
    private $id_utilisateurs;
    private $photo_profile;
    private $date_inscription;
    public function __construct(string $nom, string $prenom,  $email,  $pass,  $date_naissance, $date_inscription, $photo_profile = "beeding.jpg")
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->pass = $pass;
        $this->date_naissance = $date_naissance;
        $this->date_inscription = $date_inscription;
        $this->photo_profile = $photo_profile;
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

    public function getPass(): string
    {
        return $this->pass;
    }

    public function getDate_naissance(): string
    {
        return $this->date_naissance;
    }
    public function getId_utilisateurs(): int
    {
        return $this->id_utilisateurs;
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

    public function setPass(string $pass)
    {
        $this->pass = $pass;
    }

    public function setDate_naissance(string $date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    public function get_photo()
    {
        return $this->photo_profile;
    }

    public function set_photo($photo)
    {
        $this->photo_profile = $photo;
    }

    public function get_date_inscription()
    {
        return $this->date_inscription;
    }

    public function set_date_inscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
        return $this->date_inscription;
    }
}
