<?php 
namespace config;
use PDO;
use PDOException;

class Config {
    private static $pdo = null;
    private $connexion;

    private function __construct() {
        $host = 'localhost';
        $db_name = 'urbanhome';
        $username = 'root';
        $password = '';

        try {
            $this->connexion = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getpdo() {
        if (self::$pdo === null) {
            self::$pdo = new Config();
        }
        return self::$pdo;
    }

    public function getconnexion() {
        return $this->connexion;
    }
}
