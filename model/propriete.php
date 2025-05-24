<?php  
namespace model;

class Propriete{
    private int $id_type;
    private string $etat;
    private $opt;
    private string $situation_geo;
    private float $prix;
    private string $image1;
    private string $image2;
    private string $image3;
    private string $descriptions;
    private  $id_bailleur;
    private  $date;


    public function __construct(int $id_type, string $etat, $opt, string $situation_geo, float $prix, string $image1, string $image2, string $image3, string $descriptions,  $id_bailleur,$date)
    {
        $this->id_type = $id_type;
        $this->etat = $etat;
        $this->opt = $opt;
        $this->situation_geo = $situation_geo;
        $this->prix = $prix;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->descriptions = $descriptions;
        $this->id_bailleur = $id_bailleur;
        $this->date = $date;
    }

    public function getIdType(): string
    {
        return $this->id_type;
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
        return $this->situation_geo;
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
        return $this->descriptions;
    }
    public function getIdbailleur(): string
    {
        return $this->id_bailleur;
    }
    public function setType(int $id_type)
    {
        $this->id_type = $id_type;
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
        $this->situation_geo = $adresse;
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
        $this->descriptions = $description;
    }
    public function setId_bailleur(int $id_bailleur)
    {
        $this->id_bailleur = $id_bailleur;
    }
    public function getDate(){
        return $this->date;
    }
      public function SetDate($date){
        return $this->date=$date;
    }

}