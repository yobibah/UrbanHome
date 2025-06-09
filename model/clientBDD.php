<?php
namespace model;
//require_once __DIR__ . '/../vendor/autoload.php';
use config\Config;
use PDO;
use model\Client;
use model\Achat;
use model\Location;
use model\Propriete;
use model\ProprieteBDD;

class clientBDD extends Client
{

    private $pdo;
    public function __construct()
    {
        // on instancie la classe Config pour avoir accés à la base de données
        // et on l'initialise
        $this->pdo = Config::getpdo()->getconnexion();


    }

    // function pour inserer un nouveau client
    public function insertClient(Client $client): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO client (nom, prenom, adresse,email,telephone,mot_de_passe,id_agent ) VALUES (:nom, :prenom, :adresse,:email, :telephone,:mot_de_passe,:id_agent )");
        return $stmt->execute([
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'email' => $client->getEmail(),
            'mot_de_passe' => $client->getPassword(),
            'telephone' => $client->getNumero_telephone(),

            'adresse' => $client->getAdresse(),
            'id_agent' => $client->getId_agent(),
        ]);
    }

    // function pour recuperer un client par son email
    public function getClientTelephone(string $telephone)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE telephone = ?");
        $stmt->execute([$telephone]);
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clients = [];

        foreach ($data as $row) {
            $clients[] = [
                'id' => $row['id_client'],
                'objet' => new Client($row['nom'], $row['prenom'], $row['adresse'], $row['email'], $row['numero_telephone'], $row['motd_de_passe'], $row['id_agent']),

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
                'objet' => new Client($row['nom'], $row['prenom'], $row['adresse'], $row['email'], $row['numero_telephone'], $row['motd_de_passe'], $row['id_agent']),

            ];
        }
        return $clients;
    }

    // function pour recuperer un client par son id

    public function updateClient($id, Client $client): bool
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
            ':id' => $id
        ]);
    }

    // function pour recuperer tous les clients
    public function getAllClients($limit, $ofset)
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
                'objet' => new Client($row['nom'], $row['prenom'], $row['adresse'], $row['email'], $row['numero_telephone'], $row['motd_de_passe'], $row['id_agent']),

            ];
        }
        return $clients;
    }

    // foction pour se connecter
    public function LoginClient($telephone, $password)
    {
    $stmt = $this->pdo->prepare("SELECT * FROM client WHERE telephone = :telephone");
    $stmt->execute([':telephone'=>$telephone]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $data) {
        if (password_verify($password, $data['mot_de_passe'])) {
            return [
                'id' => $data['id_client'],
                'objet' => new Client($data['nom'], $data['prenom'], $data['adresse'], $data['email'], $data['telephone'], $data['mot_de_passe'], $data['id_agent']),
            ];
        }
}
        return null; // Si aucun client trouvé ou mot de passe incorrect
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


    public function dejaFavoris($id_client, $id_propriete): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM favoris WHERE id_client = :id_client AND id_propiete = :id_propiete");
        $stmt->execute([
            ':id_client' => $id_client,
            ':id_propiete' => $id_propriete
        ]);
        return $stmt->rowCount() > 0; // Retourne true si déjà favorisé, false sinon
    }   

    public function favoriserPropriete($id_client, $id_propriete, $date_ajout)
    {
        $stmt = $this->pdo->prepare("INSERT INTO favoris (id_client, id_propiete,date_ajout) VALUES (:id_client, :id_propiete, :date_ajout)");
        return $stmt->execute([
            ':id_client' => $id_client,
            ':id_propiete' => $id_propriete,
            ':date_ajout' => $date_ajout
        ]);
    }

public function getFavorisByClient($id_client, $limit, $offset): array
{
    $sql = "
        SELECT 
            f.id_favoris,
            f.id_client,
            f.id_propiete,
            f.date_ajout,
            p.image1,
            p.prix,
            t.libelle
        FROM favoris f
        JOIN propriete p ON p.id_propiete = f.id_propiete
        JOIN type_propriete t ON t.id_type = p.id_type
        WHERE f.id_client = :id_client
        ORDER BY f.date_ajout DESC
        LIMIT :limit OFFSET :offset
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function supprimerFavoris($id_client, $favoris): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM favoris WHERE id_client = :id_client AND id_favoris = :id_favoris");
        return $stmt->execute([
            ':id_client' => $id_client,
            ':id_favoris' => $favoris 
        ]);
    }
    public function countFavorisByClient($id_client): int
{
    $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM favoris WHERE id_client = :id");
    $stmt->execute([':id' => $id_client]);
    return (int) $stmt->fetchColumn();
}

public function Prendre_rendevez( $id_client, $id_propriete, $date_rendez_vous, $id_statut,$descriptions): bool
{
    $stmt = $this->pdo->prepare("INSERT INTO rendezvous (id_client, id_propriete, date_rdv,id_statut,descriptions) VALUES (:id_client, :id_propriete, :date_rdv, :id_statut, :descriptions)");
    return $stmt->execute([
        ':id_client' => $id_client,
        ':id_propriete' => $id_propriete,
        ':date_rdv' => $date_rendez_vous,
        ':id_statut' => $id_statut,
        ':descriptions' => $descriptions
    ]);

}

public function IdRdv($statut){
    $stmt = $this->pdo->prepare("SELECT id_statut FROM statut_rendezvous WHERE statut = :statut");
    $stmt->bindParam(':statut', $statut, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($data) {
        return $data['id_statut'];
    }
    
    return null; // Si aucun rendez-vous trouvé avec ce statut
}

public function verifierRendezVous($id_client, $id_propriete): bool {
    $stmt = $this->pdo->prepare("SELECT * FROM rendezvous WHERE id_client = :id_client AND id_propriete = :id_propriete ");
    $stmt->execute([
        ':id_client' => $id_client,
        ':id_propriete' => $id_propriete,
       
    ]);
    return $stmt->rowCount() > 0;
}
}