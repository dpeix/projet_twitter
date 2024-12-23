Projet Twitter Clone avec Symfony
Ce projet est un clone simplifié de Twitter, développé avec Symfony, Twig et MySQL. L'objectif est de recréer une plateforme de microblogging similaire à Twitter, permettant aux utilisateurs de publier des tweets, de suivre d'autres utilisateurs et d'interagir avec des posts.

Table des matières
Description
Technologies utilisées
Installation
Configuration de la base de données
Utilisation
Contribuer
Licence
Description
Ce projet vise à recréer une version basique de Twitter, en incluant les fonctionnalités suivantes :

Inscription et authentification des utilisateurs.
Publication de tweets.
Possibilité de suivre d'autres utilisateurs.
Affichage de tweets sur le fil d'actualités.
Interface simple et intuitive avec Twig.
Ce projet est développé avec le framework Symfony et utilise MySQL comme système de gestion de base de données.

Technologies utilisées
Symfony : Framework PHP pour le développement web.
Twig : Moteur de templates pour générer des vues dynamiques.
MySQL : Système de gestion de base de données relationnelle.
Bootstrap : Framework CSS pour le design responsive.
Composer : Gestionnaire de dépendances pour PHP.
Installation
Prérequis
PHP 8.1 ou supérieur
Composer
MySQL ou MariaDB
Étapes d'installation
Clonez le dépôt :

Ouvrez un terminal et clonez le projet sur votre machine locale :

git clone https://github.com/ton-utilisateur/ton-repository.git
Accédez au répertoire du projet :

cd ton-repository
Installez les dépendances :

Utilisez Composer pour installer les dépendances PHP nécessaires :

composer install
Configurez la base de données :

Créez une base de données MySQL pour le projet. Puis, modifiez le fichier .env à la racine du projet pour configurer les paramètres de connexion à la base de données :

DATABASE_URL="mysql://root:password@127.0.0.1:3306/twitter_clone?serverVersion=5.7"
Créez les tables de la base de données :

Après avoir configuré votre base de données, vous devez créer les tables en exécutant la commande suivante :

php bin/console doctrine:migrations:migrate
Démarrez le serveur de développement Symfony :

Vous pouvez maintenant démarrer le serveur de développement Symfony pour tester votre projet localement :

symfony serve
Accédez à l'application :

Ouvrez votre navigateur et allez à http://localhost:8000 pour voir l'application en action.

Configuration de la base de données
Le projet utilise MySQL pour la gestion des données. Assurez-vous que la base de données est correctement configurée dans le fichier .env.

Voici un exemple de configuration pour une base de données locale :

DATABASE_URL="mysql://root:password@127.0.0.1:3306/twitter_clone?serverVersion=5.7"
Une fois que vous avez configuré la base de données, vous pouvez exécuter les migrations pour créer les tables :

php bin/console doctrine:migrations:migrate
Utilisation
Fonctionnalités principales
Inscription et authentification des utilisateurs : Les utilisateurs peuvent s'inscrire avec une adresse e-mail et un mot de passe. L'authentification est gérée via Symfony Security.
Publication de tweets : Une fois connecté, les utilisateurs peuvent publier des tweets (messages de 280 caractères maximum).
Suivre des utilisateurs : Les utilisateurs peuvent suivre d'autres utilisateurs pour voir leurs tweets dans leur fil d'actualités.
Fil d'actualités : Les utilisateurs peuvent voir les tweets des personnes qu'ils suivent.
Routes disponibles
/ : Accueil, affiche les tweets des utilisateurs suivis.
/login : Formulaire de connexion.
/register : Formulaire d'inscription.
/profile : Profil de l'utilisateur, avec la possibilité de publier des tweets.
Contribuer
Forkez le projet.
Créez une branche pour votre fonctionnalité (git checkout -b feature/ma-nouvelle-fonctionnalité).
Committez vos changements (git commit -am 'Ajout d\'une nouvelle fonctionnalité').
Pushez la branche (git push origin feature/ma-nouvelle-fonctionnalité).
Ouvrez une Pull Request.
Licence
Ce projet est sous la licence MIT.

