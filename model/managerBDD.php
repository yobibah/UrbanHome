<?php 
namespace model;
use config\Config;
use model\Manager;

class ManagerBDD extends Manager {
    private $pdo;
    public function __construct()
    {
        $this->pdo =Config::getpdo()->getconnexion();
    }
    
    public function addManager(Manager $manager) {
        $stmt = $this->pdo->prepare("INSERT INTO manager (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)");
        $stmt->bindValue(':nom', $manager->getNom());
        $stmt->bindValue(':prenom', $manager->getPrenom());
        $stmt->bindValue(':email', $manager->getEmail());
        $stmt->bindValue(':password', $manager->getPassword());
        return $stmt->execute();
    }

    public function getManagerByEmail(string $email) {
        $stmt = $this->pdo->prepare("SELECT * FROM manager WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $managers = [];
        foreach ($data as $row) {
            $managers[] = [
                'id' => $row['id_manager'],
                'objet' => new Manager($row['nom'], $row['prenom'], $row['email'], $row['password']),
            ];
        }
        return $managers;
    }

    public function LoginManager(string $email, string $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM manager WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $managers = [];
        foreach ($data as $row) {
            $managers[] = [
                'id' => $row['id_manager'],
                'objet' => new Manager($row['nom'], $row['prenom'], $row['email'], $row['password']),
            ];
        }
        return $managers;
    }

    public function getManager($limit, $ofset) {
        $stmt = $this->pdo->prepare("SELECT * FROM manager LIMIT :limit OFFSET :ofset");
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':ofset', $ofset, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $managers = [];
        foreach ($data as $row) {
            $managers[] = [
                'id' => $row['id_manager'],
                'objet' => new Manager($row['nom'], $row['prenom'], $row['email'], $row['password']),
            ];
        }
        return $managers;

    }

}