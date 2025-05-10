# UrbanHome

UrbanHome est une application web de gestion immobilière développée en PHP (architecture MVC).

## Fonctionnalités principales
- Inscription et connexion des clients
- Consultation des propriétés disponibles
- Gestion des favoris
- Prise de rendez-vous pour visite ou transaction
- Espaces dédiés pour clients, bailleurs et employés

## Structure du projet
```
config/         # Configuration de l'application
controllers/    # Contrôleurs MVC
model/          # Modèles de données
public/         # Point d'entrée (index.php) et ressources publiques
routes/         # Définition des routes
src/            # Classes utilitaires et base de données
views/          # Vues (pages HTML, assets, etc.)
```

## Démarrage rapide
1. Cloner le dépôt
2. Configurer la base de données dans `config/config.php`
3. Lancer un serveur local sur le dossier `public/`
4. Accéder à l'application via `http://localhost:8000` (ou autre port)

## Auteurs
- Projet réalisé par l'équipe UrbanHome
