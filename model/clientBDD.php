<?php 
namespace model;

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

}