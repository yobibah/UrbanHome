<?php 
namespace model;
require_once('vendor/autoload.php');

use config\Config;
use PDO;
use model\Client;

class clientBDD extends Client{

    private $pdo;
    public function __construct(){
        $this->pdo=Config::getpdo()->getconnexion();

    }

    public function verifie_users($email) {
        $req = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $req->execute(['email' => $email]);
        $count = $req->fetchColumn();
    
        return $count > 0;
    }
    

    public function login($email, $pass) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($pass, $user['pass'])) {
            return [
                'id' => $user['id_utilisateur'],
                'objet' => new Client(
                    $user['nom'],
                    $user['prenom'],
                    $user['email'],
                    $user['pass'],
                    $user['date_naissance'],
                    $user['date_inscription'],
                    $user['photo_profile'] ?? null
                )
            ];
        }
    
        return false; // login échoué
    }
    
    public function nouveau_users(Client $users){

        $smt=$this->pdo->prepare("INSERT INTO users (nom,prenom, email, pass, date_naissance,date_inscription,photo_profile) VALUES (:nom,:prenom, :email, :pass, :date_naissance,:date_inscription,:photo_profile)");
        $smt->execute([
            'nom'=>$users->getNom(),
            'prenom'=>$users->getPrenom(),
            'email'=>$users->getEmail(),
            'pass'=>$users->getPass(),
            'date_naissance'=>$users->getDate_naissance(),
            'date_inscription'=>$users->get_date_inscription(),
            'photo_profile'=>$users->get_photo()
        ]
        
        );
        return $smt;
    }


    public function get_users($limit, $offset){
        $req= "SELECT * FROM users LIMIT $limit OFFSET $offset";
        $smt=$this->pdo->prepare($req);
        $smt->execute();
        $resul= $smt->fetchAll();

        $rep=[];
        foreach($resul as $result){
            $rep[]= [
                'id' => $result['id'],
                'objet'=>new Client( $result['nom'], $result['prenom'], $result['email'], $result['pass'], $result['date_naissance'], $result['date_inscription'], $result['photo_profile'])
            ];
        }
        return $rep;
    }


    public function get_user($id){
        $req= "SELECT * FROM users WHERE id_utilisateur = $id";
        $smt=$this->pdo->prepare($req);
        $smt->execute();
        $results= $smt->fetchAll();
        $rep =[];
        foreach($results as $result){
            $rep[]= [
                'id' => $result['id'],
                'objet'=>new Client( $result['nom'], $result['prenom'], $result['email'], $result['pass'], $result['date_naissance'], $result['date_inscription'], $result['photo_profile'])
            ];
        }
        return $rep;
    }

    public function update_users(Client $users,$id){
        $smt=$this->pdo->prepare("UPDATE users SET nom=:nom, prenom=:prenom, email=:email, pass=:pass, date_naissance=:date_naissance, date_inscription=:date_inscription, photo_profile=:photo_profile WHERE id=:id");
        $smt->execute([
            'id'=>$id(),
            'nom'=>$users->getNom(),
            'prenom'=>$users->getPrenom(),
            'email'=>$users->getEmail(),
            'pass'=>$users->getPass(),
            'date_naissance'=>$users->getDate_naissance(),
            'date_inscription'=>$users->get_date_inscription(),
            'photo_profile'=>$users->get_photo()
        ]);
    }
    
    public function delete_users($id){
        $smt=$this->pdo->prepare("DELETE FROM users WHERE id=:id");
        $smt->execute([
            'id'=>$id()
        ]);
        return $smt;


    }

public function deconnexion($id){
session_start();
$_SESSION['id'];
session_destroy();
}

}