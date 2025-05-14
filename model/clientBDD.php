<?php 
namespace model;
require_once __DIR__ . '/../vendor/autoload.php';
use config\Config;
use PDO;
use model\Client;

class clientBDD extends Client{

    private $pdo;
    public function __construct(){
        // on instancie la classe Config pour avoir accés à la base de données
        // et on l'initialise
         $this->pdo=Config::getpdo()->getconnexion();

       
    }

    public function insertClient($idagent ,Client $client): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO client (nom, prenom, adresse,email,telephone,mot_de_passe,id_agent ) VALUES (:nom, :prenom, :adresse,:email, :telephone,:mot_de_passe,:id_agent )");
        return $stmt->execute([
          'nom'=> $client->getNom(),
            'prenom'=>$client->getPrenom(),
           'email'=> $client->getEmail(),
            'mot_de_passe'=>$client->getPassword(),
            'telephone'=>$client->getNumero_telephone(),
    
           'adresse'=> $client->getAdresse(),
            'id_agent'=> $client->getId_agent(),
        ]);
    }

    public function getClientByEmail(string $email): ?Client
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Client($row['nom'], $row['prenom'], $row['adresse'], $row['email'], $row['numero_telephone'], $row['motd_de_passe'], $row['id_agent']);
        }
        return null;
    }

    public function getClientById(int $id): ?Client
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Client($row['nom'], $row['prenom'], $row['adresse'], $row['email'], $row['numero_telephone'], $row['motd_de_passe'], $row['id_agent']);
        }
        return null;
    }


    public function updateClient($id,Client $client): bool
    {
        $stmt = $this->pdo->prepare("UPDATE client SET nom = ?, prenom = ?, email = ?, password = ?, numero_telephone = ?, username = ?, adresse = ? WHERE id = ?");
        return $stmt->execute([
            $client->getNom(),
            $client->getPrenom(),
            $client->getEmail(),
            $client->getPassword(),
            $client->getNumero_telephone(),
      
            $client->getAdresse(),
            
           
        ]);
    }

    public function deleteClient($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM client WHERE id_client = ?");
        return $stmt->execute([$id]);
    }

    public function getAllClients(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clients = [];

        foreach ($data as $row) {
            $clients[] = [
                'id' => $row['id_client'],
               'objet'=> new Client($row['nom'], $row['prenom'], $row['adresse'], $row['email'], $row['numero_telephone'], $row['motd_de_passe'], $row['id_agent']),
        
            ];
        }
        return $clients;
    }


}

//test sur limplementation de la classe Clientz
$client = new Client("Doe", "John", "john@example.com", "password123", "1234567890", "123 Main St",2);
$dao = new clientBDD();
$dao->insertClient(1,$client);
$clients = $dao->getAllClients();
foreach ($clients as $client) {
    echo $client->getNom() . " " . $client->getPrenom() . "<br>";
}