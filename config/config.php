<?php 
namespace config;
require_once __DIR__ . '/../vendor/autoload.php';
use PDO;
use PDOException;
use Dotenv\Dotenv;

class Config {
    private static $pdo = null;
    private $connexion;

    private function __construct() {
        $dotenv =  Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
        
    $host = $_ENV['DB_HOST'];
    $db_name   = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];
       /*
        $host = 'localhost';
        $db_name = 'urbanhome';
        $username = 'root';
        $password = '';
        */

          

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
