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
   composer require vlucas/phpdotenv
   ```

5. Configurer les variables d'environnement dans un fichier `.env` (exemple : connexion à la base de données).

6. Lancer le serveur PHP intégré :

   ```powershell
   php -S localhost:8000 -t public
   ```

7. Accéder à l'application via [http://localhost:8000](http://localhost:8000)

## Structure des dossiers

- `public/` : point d'entrée de l'application (front controller)

- `views/` : vues et layouts (header, footer, navbar, erreurs, etc.)

- `controllers/` : contrôleurs pour gérer la logique métier

- `model/` : modèles et accès base de données

- `config/` : configuration (connexion PDO, etc.)

- `routes/` : gestion des routes définies dans `Router.php`

- `assets/` : ressources statiques (CSS, JS, images)

## Routes principales

### Public

- `/` : Page d'accueil

- `/public/about` : À propos

- `/public/contact` : Contact

### Propriétés

- `/propriete/liste` : Liste des propriétés

- `/propriete/detail` : Détail d'une propriété

### Bailleur

- `/bailleur` : Connexion bailleur

- `/bailleur/inscription` : Inscription bailleur

- `/bailleur/dashboard` : Tableau de bord du bailleur

- `/bailleur/biens` : Gestion des biens

- `/bailleur/contrats` : Gestion des contrats

- `/bailleur/paiements` : Gestion des paiements

- `/bailleur/messages` : Messagerie

### Client

- `/client/dashboard` : Tableau de bord du client

- `/client/locations` : Liste des locations

## Fonctionnalités récentes

- Gestion des propriétés : ajout, modification, suppression.

- Messages flash basés sur les sessions pour les retours utilisateur.

- Formulaires dynamiques pour les bailleurs et les clients.

- Tableau de bord interactif pour les bailleurs avec indicateurs clés (KPI).

## Conseils

- Adaptez les fichiers de configuration à votre environnement (BDD, mail, etc.).

- Pour la production, configurez votre serveur pour que seul le dossier `public/` soit accessible publiquement.

- Consultez les fichiers d'exemple dans `views/error/` pour personnaliser les pages d'erreur.

## Tableau de bord du bailleur

Le tableau de bord du bailleur inclut :

- **En-tête** : Vue d'ensemble des indicateurs clés (KPI).

- **Liste des propriétés** : Gestion des biens immobiliers.

- **Contrats** : Suivi des contrats en cours et terminés.

- **Paiements** : Historique et gestion des paiements.

- **Messagerie** : Communication avec les clients et gestion des messages.

- **Actions rapides** : Ajout de nouvelles propriétés, gestion des profils, etc.

Bonne utilisation de UrbanHome !

