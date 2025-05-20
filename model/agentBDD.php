<?php 
namespace model;
use config\Config;
use model\Agent;
use model\Client;

class AgentBDD extends Config{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Config::getPdo()->getconnexion();
    }

    //ajouter un agent
    public function addAgent(Agent $agent): bool
    {
        $conx = "INSERT INTO agent (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)";
        $stmt = $this->pdo->prepare($conx);
        $stmt->bindValue(':nom', $agent->getNom());
        $stmt->bindValue(':prenom', $agent->getPrenom());
        $stmt->bindValue(':email', $agent->getEmail());
        $stmt->bindValue(':telephone', $agent->getTelephone());
        $stmt->bindValue(':mot_de_passe', ($agent->getPassword()));
        return $stmt->execute();
    }
    // function pour recuperer un agent par son email
    public function getAgentByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agent WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $agents = [];
        foreach ($data as $row) {
            $agents[] = [
                'id' => $row['id_agent'],
                'objet'=> new Agent($row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $agents;
    }
    // function pour recuperer un agent par son id
    public function getAgentById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agent WHERE id_agent = :id");
        $stmt->execute([':id'=>$id]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $agents = [];
        foreach ($data as $row) {
            $agents[] = [
                'id' => $row['id_agent'],
                'objet'=> new Agent($row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $agents;
    }
    // function pour recuperer tous les agents
    public function getAllAgents($limit,$ofset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agent 
        LIMIT :limit OFFSET :ofset");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $agents = [];
        foreach ($data as $row) {
            $agents[] = [
                'id' => $row['id_agent'],
                'objet'=> new Agent($row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $agents;
    }

    public function agent_not_affected(){
        $stmt = $this->pdo->prepare("SELECT * FROM agent WHERE id_agent NOT IN (SELECT id_agent FROM client)");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $agents = [];
        foreach ($data as $row) {
            $agents[] = [
                'id' => $row['id_agent'],
                'objet'=> new Agent($row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $agents;
    }


    public function LoginAgent($email,$password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agent WHERE email = ? AND mot_de_passe = ?");
        $stmt->execute([$email,$password]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $agents = [];
        foreach ($data as $row) {
            $agents[] = [
                'id' => $row['id_agent'],
                'objet'=> new Agent($row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $agents;
    }
    
}