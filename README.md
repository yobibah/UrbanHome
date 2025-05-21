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

## Tableau de bord du bailleur

### 1. En-tête personnalisé
- Logo UrbanHome
- Nom du bailleur (ex. : "Bienvenue, M. Diallo")
- Photo de profil (optionnelle)
- Menu de navigation : Tableau de bord | Mes biens | Mes contrats | Paiements | Déconnexion

### 2. Statistiques clés (KPIs)
Affichées sous forme de cartes ou de tuiles :
- Nombre total de biens en location
- Nombre de contrats actifs
- Paiements en attente
- Nouveaux messages ou demandes

### 3. Liste des biens immobiliers
Tableau interactif avec les colonnes suivantes :
- Nom du bien
- Adresse
- Statut (Disponible, Loué, En maintenance)
- Actions : Voir | Modifier | Supprimer

### 4. Contrats récents
Section présentant les derniers contrats signés ou en cours de signature, avec des détails tels que :
- Nom du locataire
- Date de début
- Durée
- Montant du loyer

### 5. Paiements récents
Tableau listant les derniers paiements reçus ou en attente, incluant :
- Nom du locataire
- Montant
- Date de paiement
- Statut (Payé, En attente)

### 6. Messagerie
Interface pour consulter et répondre aux messages des locataires ou de l'administration :
- Liste des conversations
- Zone de rédaction
- Notifications pour les nouveaux messages

### 7. Actions rapides
Boutons ou liens pour :
- Ajouter un nouveau bien
- Créer un nouveau contrat
- Envoyer un message
- Télécharger un rapport

Bonne utilisation de UrbanHome !

