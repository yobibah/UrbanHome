<?php
namespace Yobib\UrbanHome;

use Yobib\UrbanHome\Database;

class App
{
    public static function init()
    {
        // Charger la configuration
        require_once __DIR__ . '/../config/config.php';

        // Démarrer la session si nécessaire
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Initialiser la connexion à la base de données (exemple)
        $db = Database::getInstance()->getConnection();

        // Charger d'autres services globaux ici si besoin
    }
}
