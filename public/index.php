<?php
// Point d'entrée principal (front controller)
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/App.php';

use src\App;
use routes\Router;
use controllers\HomeControllers;
use controllers\BailleurControllers;
use controllers\ClientControllers;

App::init();
// Gestion du chemin des assets pour test local (sans -t public) ou production
if (php_sapi_name() === 'cli-server' && basename(__DIR__) !== 'public') {
    // Mode test local sans -t public
    define('ASSET_PATH', '/public/assets/');
} else {
    // Production ou test avec -t public
    define('ASSET_PATH', '/assets/');
}
// Pour la production, on utilise un chemin absolu sécurisé pour les vues
define('VIEW_PATH', realpath(__DIR__ . '/../views/') . DIRECTORY_SEPARATOR);

$router = new Router();
// point d'entrée pour les routes
$router->register('/', ['controllers\HomeControllers', 'home']);

//espaces bailleur
$router->register('/propriete', ['controllers\HomeControllers', 'listes_prorpietes_home']);
$router->register('/register', ['controllers\BailleurControllers', 'register']);
$router->register('/add', ['controllers\BailleurControllers', 'add']);
$router->register('/mes-proprietes', ['controllers\BailleurControllers', 'mes_propietes']);
$router->register('/Mon-profil', ['controllers\BailleurControllers', 'profile']);
$router->register('/modifier-propriete', ['controllers\BailleurControllers', 'modifier_propriete']);
$router->register('/modifier', ['controllers\BailleurControllers', 'update_propriete']);
$router->register('/detail_propriete', ['controllers\BailleurControllers', 'detail']);  
$router->register('/supprimer-propriete', ['controllers\BailleurControllers', 'supprimer_propriete']);
$router->register('/logout', ['controllers\BailleurControllers', 'logout']);
$router->register('/home-bailleur', ['controllers\BailleurControllers', 'login_Bailleur']);
$router->register('/Nouvelle-Propiete', ['controllers\BailleurControllers', 'NouvellePropiete']);
$router->register('/bailleur', ['controllers\HomeControllers', 'connexion_baileur']);
$router->register('/detail', ['controllers\HomeControllers', 'detail']);
$router->register('/Inscription', ['controllers\HomeControllers', 'connexion_bail']);

//espaces client
$router->register('/client', ['controllers\HomeControllers', 'connexion_client']);
$router->register('/Mon-inscription', ['controllers\ClientControllers', 'NouveauClient']);
$router->register('/Espace-client/proprietes/detail', ['controllers\ClientControllers', 'detail_propriete']);
$router->register('/se-connecter', ['controllers\ClientControllers', 'LoginClient']);
$router->register('/listes-proprietes', ['controllers\ClientControllers', 'proprietes']);
$router->register('/ajouter-favoris', ['controllers\ClientControllers', 'add_favoris']);
$router->register('/tableau-de-bord', ['controllers\ClientControllers', 'dash']);
$router->register('/supprimer-favoris', ['controllers\ClientControllers', 'supprimer_favoris']);
$router->register('/Espace-client/proprietes/rdv/add', ['controllers\ClientControllers', 'PrendreRendezVous']);
$router->register('/rendez-vous', ['controllers\ClientControllers', 'rdv']);
$router->register('/propriete/mes-proprietes-favoris', ['controllers\ClientControllers', 'list_favoris']);
$router->register('/mon-profil', ['controllers\ClientControllers', 'mon_profil']);
$router->register('/modifier-mon-profil', ['controllers\ClientControllers', 'modifier_profil']);
$router->register('/inscription-client', ['controllers\HomeControllers', 'inscription_client']);
try {
    $router->resolve($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    echo $e->getMessage();
}
