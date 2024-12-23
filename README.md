# Projet BTS SIO SLAM : Clone de Twitter

## Description du projet
Ce projet consiste à développer un clone de Twitter en utilisant les technologies suivantes :
- **Symfony** : framework PHP pour le développement back-end.
- **Twig** : moteur de templating pour le rendu des pages HTML.
- **MySQL** : système de gestion de base de données relationnelles.

L'objectif est de créer une application web permettant aux utilisateurs de publier des tweets, d'interagir avec les publications d'autres utilisateurs (likes, retweets) et de gérer leur profil.

## Fonctionnalités principales
1. **Gestion des utilisateurs**
   - Inscription et connexion.
   - Gestion de profil (modification des informations, mot de passe).

2. **Publication de tweets**
   - Création, modification et suppression de tweets.
   - Affichage des tweets avec les informations suivantes :
     - Identifiant du tweet (`id`)
     - Identifiant de l'utilisateur (`user_id`)
     - Date de création (`created_at`)
     - Contenu (`content`)
     - Nombre de likes (`likes`)
     - Nombre de retweets (`retweets`)
     - État du tweet (`state` : actif/inactif).

3. **Interactions utilisateur**
   - Aimer et retweeter des publications.

4. **Affichage dynamique**
   - Liste des tweets affichée par ordre chronologique.
   - Interface utilisateur responsive.

## Structure du projet
- **Backend** :
  - Framework : Symfony.
  - Gestion des routes et des contrôleurs pour le traitement des requêtes HTTP.
  - Validation des formulaires et sécurité.

- **Frontend** :
  - Moteur de templating Twig pour la génération des pages.
  - Utilisation de Bootstrap pour le style et la responsivité.

- **Base de données** :
  - MySQL pour la gestion des entités (utilisateurs, tweets, likes, retweets).

## Prérequis
- PHP >= 8.1
- Composer
- Symfony CLI
- Serveur web (Apache ou Nginx)
- MySQL

## Installation
1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/votre-repo/clone-twitter-symfony.git
   cd clone-twitter-symfony
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   ```

3. **Configurer l'application** :
   - Copier le fichier `.env` :
     ```bash
     cp .env .env.local
     ```
   - Modifier les variables de connexion à la base de données dans `.env.local` :
     ```env
     DATABASE_URL="mysql://user:password@127.0.0.1:3306/clone_twitter"
     ```

4. **Initialiser la base de données** :
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. **Lancer le serveur** :
   ```bash
   symfony server:start
   ```

6. **Accéder à l'application** :
   Ouvrez un navigateur et accédez à [http://localhost:8000](http://localhost:8000).

## Utilisation
- Créez un compte utilisateur.
- Publiez vos tweets.
- Explorez les publications et interagissez avec elles.

## Auteur
**[Votre Prénom et Nom]**
- Étudiant en BTS SIO SLAM.
- Passionné par le développement web et mobile.

## Licence
Ce projet est réalisé dans le cadre d'un cursus scolaire et n'est pas destiné à une utilisation commerciale.

---
*Ce document peut être modifié et adapté selon vos besoins.*

