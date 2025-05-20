<?php
namespace model;
use config\Config;

class BailleurBDD extends Bailleur
{
    private $pdo;
    public function __construct()
    {
        // on instancie la classe Config pour avoir accés à la base de données
        // et on l'initialise
        $this->pdo = Config::getpdo()->getconnexion();
    }
    public function insertBailleur(Bailleur $bailleur): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO bailleur (nom, prenom, adresse,email,telephone,mot_de_passe,raison_social) VALUES (:nom, :prenom, :adresse,:email, :telephone,:mot_de_passe,:raison_social)");
        return $stmt->execute([
            'nom' => $bailleur->getNom(),
            'prenom' => $bailleur->getPrenom(),
            'email' => $bailleur->getEmail(),
            'mot_de_passe' => $bailleur->getPassword(),
            'telephone' => $bailleur->getTelephone(),
            'adresse' => $bailleur->getAdresse(),
            'raison_social' => $bailleur->getRaisonSocial(),
        ]);
    }

    public function getBailleurByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bailleur WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $bailleurs = [];
        foreach ($row as $data) {
            $bailleurs[] = [
                'id' => $data['id_bailleur'],
                'objet' => new Bailleur($data['nom'], $data['prenom'], $data['raison_social'], $data['adresse'], $data['email'], $data['telephone'], $data['mot_de_passe']),
            ];
        }
        return $bailleurs;
    }

    public function getBailleurById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bailleur WHERE id_bailleur = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $bailleurs = [];
        foreach ($data as $row) {
            $bailleurs[] = [
                'id' => $row['id_bailleur'],
                'objet' => new Bailleur($row['nom'], $row['prenom'], $row['raison_social'], $row['adresse'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $bailleurs;
    }

    public function getAllBailleurs()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bailleur");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $bailleurs = [];
        foreach ($data as $row) {
            $bailleurs[] = [
                'id' => $row['id_bailleur'],
                'objet' => new Bailleur($row['nom'], $row['prenom'], $row['raison_social'], $row['adresse'], $row['email'], $row['telephone'], $row['mot_de_passe']),
            ];
        }
        return $bailleurs;
    }


    public function updateBailleur($id, $nom, $prenom, $email, $mot_de_passe, $telephone, $adresse, $raison_social): bool
    {
        $stmt = $this->pdo->prepare("UPDATE bailleur SET nom = ?, prenom = ?, email = ?, mot_de_passe = ?, telephone = ?, adresse = ?, raison_social = ? WHERE id_bailleur = ?");
        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $mot_de_passe,
            $telephone,
            $adresse,
            $raison_social,
            $id
        ]);
    }
    public function deleteBailleur($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM bailleur WHERE id_bailleur = :id");
        return $stmt->execute([':id' => $id]);

    }

    // pas de medthode pour l'instant

    
    public function loginBailleur($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bailleur WHERE email = :email ");
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(password_verify($password, $row['mot_de_passe'])){
            $bailleurs = [];
            foreach ($row as $data) {
                $bailleurs[] = [
                    'id' => $data['id_bailleur'],
                    'objet' => new Bailleur($data['nom'], $data['prenom'], $data['raison_social'], $data['adresse'], $data['email'], $data['telephone'], $data['mot_de_passe']),
                ];
            }
            return $bailleurs;
        }
        else{
            return false;
        }
            
       
    }

    public function verifierEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bailleur WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return count($row) > 0;
    }
}
