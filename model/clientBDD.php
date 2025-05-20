<?php 
namespace model;
//require_once __DIR__ . '/../vendor/autoload.php';
use config\Config;
use PDO;
use model\Client;
use model\Achat;
use model\Location;

class clientBDD extends Client{

    private $pdo;
    public function __construct(){
        // on instancie la classe Config pour avoir accés à la base de données
        // et on l'initialise
         $this->pdo=Config::getpdo()->getconnexion();

       
    }

    // function pour inserer un nouveau client
    public function insertClient(Client $client): bool
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

    // function pour recuperer un client par son email
    public function getClientByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE email = ?");
        $stmt->execute([$email]);
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
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
// function pour recuperer un client par son id
    public function getClientById(int $id)
        {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$id]);
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

    // function pour recuperer un client par son id

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
    // function pour supprimer un client

    public function deleteClient($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM client WHERE id_client = :id");
        return $stmt->execute([
            ':id'=>$id]);
    }

    // function pour recuperer tous les clients
    public function getAllClients($limit,$ofset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client 
        LIMIT :limit OFFSET :ofset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':ofset', $ofset, PDO::PARAM_INT);
        $stmt->execute();
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

    // foction pour se connecter
    public function LoginClient($email,$password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE email = ? AND mot_de_passe = ?");
        $stmt->execute([$email, $password]);
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

// function pour acheter une propriete
public function acheterPropriete(Achat $achat): bool
{
    $stmt = $this->pdo->prepare("INSERT INTO achat (id_propriete,id_client,id_agent,date_achat) VALUES (:id_propriete,:id_client,:id_agent,:date_achat)");
    return $stmt->execute([
        'id_client' => $achat->getIdClient(),
        'id_propriete' => $achat->getIdPropriete(),
        'id_agent' => $achat->getIdAgent(),
        'date_achat' => $achat->getDateAchat(),


    ]);

}
//fonctoion pour louer des appartements

public function louerpropriete(Location $location): bool
{
    $stmt = $this->pdo->prepare("INSERT INTO location (id_propriete,id_client,id_agent,date_debut,date_fin) VALUES (:id_propriete,:id_client,:id_agent,:date_location)");
    return $stmt->execute([
        'id_client' => $location->getIdClient(),
        'id_propriete' => $location->getIdPropriete(),
        'id_agent' => $location->getIdAgent(),
        'date_debut' => $location->getDateDebut(),
        'date_fin' => $location->getDateFin(),      
    ]);
   
}

}