<?php 
namespace model;

class Location {
    private string $id_propriete;
    private string $id_client;
    private string $id_agent;

 
    private string $date_debut;
    private string $date_fin;

    public function __construct(string $id_propriete, string $id_client, string $id_agent, string $date_location, float $montant_location, string $date_debut, string $date_fin) {
        $this->id_propriete = $id_propriete;
        $this->id_client = $id_client;
        $this->id_agent = $id_agent;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }

    public function getIdPropriete(): string {
        return $this->id_propriete;
    }
    public function getIdClient(): string {
        return $this->id_client;
    }
    public function getIdAgent(): string {
        return $this->id_agent;
    }
    public function getDateDebut(): string {
        return $this->date_debut;
    }
    public function getDateFin(): string {
        return $this->date_fin;
    }
    public function setIdPropriete(string $id_propriete): void {
        $this->id_propriete = $id_propriete;
    }
    public function setIdClient(string $id_client): void {
        $this->id_client = $id_client;
    }
    public function setIdAgent(string $id_agent): void {
        $this->id_agent = $id_agent;
    }
}