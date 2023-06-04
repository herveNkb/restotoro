# Restaurant Quai Antique

Dans le cadre de ma formation de développeur web et web mobile, j'ai été amené à réaliser une évaluation qui consiste à 
développer un site web de restaurant qui se nomme le "Quai Antique".
## Fonctionnalités attendues :

- **US1. Se connecter**  
  Utilisateurs concernés: Administrateur, Clients
    >   - Le compte administrateur sera créé pour un employé du restaurant en particulier: l’hôte d’accueil.  
C’est lui qui gérera les informations sur le site web
    >   - Un autre type de compte sera possible: le “client”.
    >   - Quel que soit le type d’utilisateur souhaitant se connecter, il pourra le faire grâce au même formulaire de connexion.  
Les identifiants à entrer seront l’adresse e-mail et un mot de passe sécurisé.

- **US2.Créer une galerie d’images**  
  Utilisateurs concernés: Administrateur
    >   - Sur la page d’accueil, l'administrateur doit pouvoir afficher les photographies de ses plats les plus appréciés afin de donner l’eau à la bouche de ses potentiels convives.
    >   - Toute photo devra pouvoir être ajoutée, modifiée ou supprimée sur la plateforme d’administration.
    >   - Chaque photo aura aussi un titre. Il sera visible sur la page d’accueil lors du survol de son image.
    >   - Un bouton d’appel à l’action vers le module de réservation (Voir US6 - Réserver une table) devra être positionné juste après la galerie.

- **US3. Publier la carte**  
  Utilisateurs concernés: Administrateur
    >   - La carte du restaurant devra être présente sur une page dédiée.
    >   - Les plats seront listés dans des catégories (ex: Entrées, Desserts, Burgers, etc).
    >   - Les informations nécessaires pour chaque plat sont: un titre, une description, un prix.

- **US4. Présenter les menus**
    Utilisateurs concernés: Administrateur
    >   - Les menus du restaurant devra être présente sur une page dédiée.
    >   - Pour la page des menus, on aura: un titre, une à plusieurs formules, ayant chacune un prix et une description.

- **US5. Définir les horaires d’ouverture**
    Utilisateurs concernés: Administrateur
    >   - Pour chaque jour de la semaine, les horaires d’ouverture devront donc être affichés dans le pied de chaque page du site..
    >   - L’administrateur puisse modifier les horaires depuis le back-office.

- **US6. Réserver une table**
    Utilisateurs concernés: Visiteurs, Clients
    >   - Dans le menu, un bouton d’appel à l’action sera particulièrement mis en valeur: “réserver”.  
          Au clic de ce dernier, le visiteur est redirigé sur un formulaire à remplir.
    >   - Plusieurs champs seront nécessaires: le nombre de couverts, la date, l’heure prévue, la mention des allergies.
    >   - On pourra sélectionner un horaire par tranche de 15 minutes entre l’ouverture et la fermeture du restaurant.
    >   - Refus des réservations au-delà d’un certain seuil.  
          Par exemple, si le restaurant ne peut accueillir que 50 personnes en même temps, il ne sera pas possible de réserver pour 51 personnes.
    >   - Ce seuil de convives maximum pourra être précisé dans le panel d’administration.

- **US7. Mentionner des allergies**
    Utilisateurs concernés: Visiteurs, Clients
    >   - Lors de la réservation d’une table, le visiteur peut indiquer si une personne qui l’accompagne a des allergies.
    >   - Si le visiteur vient régulièrement dans ce restaurant, il peut aussi créer un compte client et donc gagner du temps lors de la complétion du formulaire.
    >   - Quand le visiteur créera son compte, on lui proposera d’entrer une adresse email, un mot de passe sécurisé, un nombre de convives par défaut ainsi que la mention des allergies.
    >   - si le visiteur se connecte avant de remplir le formulaire de réservation d’une table, le nombre de convives et les allergies seront remplis automatiquement avec les réglages du client.
    >   - Lors de la réservation, le visiteur pourra modifier ces informations s’il le souhaite. 

## Installation en local

Cloner le projet

```bash
  git clone https://github.com/herveNkb/restotoro.git
```

Placer vous dans le répertoire du projet

```bash
  cd restotoro
```

Créer et modifier le fichier.env selon votre environnement de travail local

Installez les dépendances avec composer

```bash
  composer install 
```

Exécutez les migrations afin de récupérer les tables de la base de données

```bash
  php bin/console doctrine:schema:update --force
```

Pour charger les données de test, exécutez les requêtes fournies dans le fichiers `sql/data.sql`

Lancer le serveur de Symfony

```bash
  Symfony server:start
```

Pour créer un compte administrateur, suivre la procédure suivante :

1- Créer un compte utilisateur  
2- Valider le compte utilisateur en cliquant sur le lien reçu par mail ou en modifiant le champ `is_valid` de la table `users` à `1`  
3- Modifier le champ `roles` de la table `users` en `["ROLE_ADMIN"]` en exécutant la requête suivante :

```sql
UPDATE `users` SET `roles` = '[\"ROLE_ADMIN\"]' WHERE `users`.`id` = 1;
```


## Déployer l'application sur un serveur web en ligne

Pour déployer ce projet, j'ai choisi un hébergeur français, très performant et très fiable qui est o2switch.

Ne connaissant pas la procédure pour d'autres hébergeurs, veuillez vous reporter à la documentation technique de l'hébergeur de votre choix.

Documentation technique pour installer une [application Symfony chez o2switch](https://faq.o2switch.fr/php/heberger-application-symfony).

Le déployement via GitHub est à privilégier (note d'o2switch).

1- Version de php → 8.0.23 ou supérieur

2- Version de composer → 2.4.1 ou supérieur

3- Version de nodeJS → 16.17.0 ou supérieur

4- Version de npm → 8.15.0 ou supérieur

5- Faire pointer le nom de domaine sur le dossier /public du projet Symfony

6- Liaison du terminal en SSH

7- Se placer dans le dossier du nom de domaine

```bash
    cd [mon-dossier ou nom-de-domaine]
```

8- Cloner le projet sur GitHub

```bash
    git clone https://github.com/herveNkb/restotoro.git
```

9- Se placer dans le dossier /restotoro

```bash
    cd restotoro
```

10- Créer le fichier .env.local et le renseigner en passant les variables en production, et en renseignant les identifiants pour la base de données.

```bash
    cp .env .env.local

    nano .env.local

    APP_ENV=prod
    APP_DEBUG=0

    DATABASE_URL="mysql://NOM_UTILISATEUR:MOT_DE_PASSE@127.0.0.1:3306/nom_base_de_donnée?serverVersion=mariadb-10.3.36&charset=utf8mb4"
```

11- Installer les dépendances

```bash
    composer install --no-dev --optimize-autoloader
```

12- Créer la base de données si elle n'existe pas et faire une migration si nécessaire

```bash
    #Création de la BDD
    php bin/console doctrine:database:create

    #Création des tables
    php bin/console doctrine:schema:create

    #Faire la migration, si nécessaire
    php bin/console doctrine:migrations:migrate
    
    #Exécuter les migrations
    php bin/console doctrine:schema:update --force
```

13- Vider et réinitialiser les caches de l'application et du serveur

```bash
    php bin/console cache:clear

    php bin/console cache:warmup
```