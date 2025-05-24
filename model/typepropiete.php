<?php 
namespace model;

class Typepropiete{
    
    private $libelle;

    public function __construct(string $libelle){
        $this->libelle=$libelle;
    }

    public function getlibele(){
        return $this->libelle;
    }

    public function setLibelle($libelle){
        return $this->libelle=$libelle;
    }
}