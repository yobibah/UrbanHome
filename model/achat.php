<?php 
namespace model;
class Achat {
    public $id_propriete;
    public $id_client;
     public $id_agent;
    public $date_achat;
    
   
    public function __construct($id_propriete, $id_client, $id_agent, $date_achat) {
        $this->id_propriete = $id_propriete;
        $this->id_client = $id_client;
        $this->id_agent = $id_agent;
        $this->date_achat = $date_achat;
    }

    public function getIdPropriete() {
        return $this->id_propriete;
    }
    public function getIdClient() {
        return $this->id_client;
    }
    public function getIdAgent() {
        return $this->id_agent;
    }
    public function getDateAchat() {
        return $this->date_achat;
    }
    public function setIdPropriete($id_propriete) {
        $this->id_propriete = $id_propriete;
    }
    public function setIdClient($id_client) {
        $this->id_client = $id_client;
    }
    public function setIdAgent($id_agent) {
        $this->id_agent = $id_agent;
    }
    public function setDateAchat($date_achat) {
        $this->date_achat = $date_achat;
    }
    
}