<?php
namespace model;
use config\Config;

class Database
{
    private static ?\PDO $instance = null;

    private function __construct()
    {
    }

    //le  fichier de configuration  dans config/config.php s'occupe de la connexion à la base de données
    // on fais juste une instance de la classe Config dans le model de donnes et ces bon;



    /*
    public static function getInstance(): \PDO
    {
        if (self::$instance === null) {
            self::$instance = new \PDO(
                Config::get('DB_DSN'),
                Config::get('DB_USER'),
                Config::get('DB_PASSWORD')
            );
        }
        return self::$instance;
    }

    */
}
    
?>