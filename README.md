# UrbanHome

UrbanHome est une application web de gestion immobilière basée sur le modèle MVC (Modèle-Vue-Contrôleur).

## Fonctionnalités principales
- Architecture MVC (Model, View, Controllers)
- Utilisation de Composer et de l'autoload PHP
- Gestion multi-utilisateurs : client, bailleur, manager
- PHPMailer pour l'envoi des codes d'inscription ou de réinitialisation
- Sécurité : token CSRF, redirection HTTPS
- Pages d'erreur personnalisées (404, 500)
- Interface responsive et moderne

## Installation
1. Placer le projet dans un serveur web local (WAMP, XAMPP, etc.) supportant PHP et MySQL
2. Importer la base de données fournie dans votre serveur MySQL
3. Ouvrir le projet dans un éditeur de code (VSCode, PhpStorm, etc.)
4. Installer les dépendances Composer :
   ```powershell
   composer install
   composer dump-autoload
   composer require vlucas/phpdotenv(pour vous permet de charger les variables environnement)
   ```
5. Lancer le serveur PHP intégré :
   ```powershell
   php -S localhost:8000 -t public
   ```
6. Accéder à l'application via [http://localhost:8000](http://localhost:8000)

## Structure des dossiers
- `public/` : point d'entrée de l'application (front controller)
- `views/` : vues et layouts (header, footer, navbar, erreurs, etc.)
- `controllers/` : contrôleurs
- `model/` : modèles et accès base de données
- `config/` : configuration (connexion PDO, etc.)
- `routes/` : gestion des routes
- `assets/` : ressources statiques (CSS, JS, images)

## Conseils
- Adaptez les fichiers de configuration à votre environnement (BDD, mail, etc.)
- Pour la production, configurez votre serveur pour que seul le dossier `public/` soit accessible publiquement.
- Consultez les fichiers d'exemple dans `views/error/` pour personnaliser les pages d'erreur.

Bonne utilisation de UrbanHome !

