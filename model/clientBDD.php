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

    public function insertClient(Client $client): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO client (nom, prenom, email, password, numero_telephone, username, adresse) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $client->getNom(),
            $client->getPrenom(),
            $client->getEmail(),
            $client->getPassword(),
            $client->getNumero_telephone(),
            $client->getusername(),
            $client->getAdresse()
        ]);
    }

    public function getClientByEmail(string $email): ?Client
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Client($data['nom'], $data['prenom'], $data['email'], $data['password'], $data['numero_telephone'], $data['username'], $data['adresse']);
        }
        return null;
    }

    public function getClientById(int $id): ?Client
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Client($data['nom'], $data['prenom'], $data['email'], $data['password'], $data['numero_telephone'], $data['username'], $data['adresse']);
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
            $client->getusername(),
            $client->getAdresse(),
            
           
        ]);
    }

    public function deleteClient($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM client WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllClients(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clients = [];

        foreach ($data as $row) {
            $clients[] = [
                'id' => $row['id'],
               'objet'=> new Client($row['nom'], $row['prenom'], $row['email'], $row['password'], $row['numero_telephone'], $row['username'], $row['adresse']),
            ];
        }
        return $clients;
    }


}

//test sur limplementation de la classe Clientz
$client = new Client("Doe", "John", "john@example.com", "password123", "1234567890", "john.doe", "123 Main St");
$dao = new clientBDD();
$dao->insertClient($client);
$clients = $dao->getAllClients();
foreach ($clients as $client) {
    echo $client->getNom() . " " . $client->getPrenom() . "<br>";
}