<?php
namespace src;

class App
{
    public static function init()
    {
        // Démarrage de la session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Chargement de la configuration globale (si besoin)
        if (file_exists(__DIR__ . '/../config/config.php')) {
            require_once __DIR__ . '/../config/config.php';
        }

        // Sécurité : Générer un token CSRF si absent
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Sécurité : Forcer l'utilisation de HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'on') {
            $httpsUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('Location: ' . $httpsUrl);
            exit();
        }
    }
}
