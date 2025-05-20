<?php  
namespace model;

class Propriete{
    private string $type;
    private string $etat;
    private $opt;
    private string $adresse;
    private float $prix;
    private string $image1;
    private string $image2;
    private string $image3;
    private string $description;
    private string $id_bailleur;


    public function __construct(string $type, string $etat, string $adresse, float $prix, string $image1, string $image2, string $image3, string $description, string $id_bailleur)
    {
        $this->type = $type;
        $this->etat = $etat;
        $this->adresse = $adresse;
        $this->prix = $prix;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->description = $description;
        $this->id_bailleur = $id_bailleur;
    }

    public function getType(): string
    {
        return $this->type;
    }
    public function getEtat(): string
    {
        return $this->etat;
    }
    public function getOpt()
    {
        return $this->opt;
    }
    public function getAdresse(): string
    {
        return $this->adresse;
    }
    public function getPrix(): float
    {
        return $this->prix;
    }
    public function getImage1(): string
    {
        return $this->image1;
    }
    public function getImage2(): string
    {
        return $this->image2;
    }
    public function getImage3(): string
    {
        return $this->image3;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getIdbailleur(): string
    {
        return $this->id_bailleur;
    }
    public function setType(string $type)
    {
        $this->type = $type;
    }
    public function setEtat(string $etat)
    {
        $this->etat = $etat;
    }
    public function setOpt($opt)
    {
        $this->opt = $opt;
    }

    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }
    public function setPrix(float $prix)
    {
        $this->prix = $prix;
    }
    public function setImage1(string $image1)
    {
        $this->image1 = $image1;
    }
    public function setImage2(string $image2)
    {
        $this->image2 = $image2;
    }
    public function setImage3(string $image3)
    {
        $this->image3 = $image3;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setId_bailleur(string $id_bailleur)
    {
        $this->id_bailleur = $id_bailleur;
    }
}