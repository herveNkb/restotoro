# Restaurant Quai Antique

Dans le cadre de ma formation de développeur web et web mobile, j'ai été amené à réaliser une évaluation qui consiste à 
développer un site web de restaurant qui se nomme le "Quai Antique".
### Fonctionnalités attendues

- **Créer une galerie d’images**   
    >   - Les photos devront pouvoir être ajoutées, modifiées ou supprimées sur la plateforme d’administration.
    >   - Chaque photo aura aussi un titre. Il sera visible sur la page d’accueil lors du survol de son image.
    >   - Un bouton d’appel à l’action vers le module de réservation devra être positionné juste après la galerie.

- **Gérer les structures**
    >   - Toute franchise peut avoir plusieurs structures (salles).
    >   - L'adresse postale de la structure sera demandée, ainsi que l'e-mail de son gérant.
    >   - Chaque structure pourra être désactivée en un click.
    >   - Un compte sera créé pour la structure avec l'email du gérant et un mot de passe sécurisé.

- **Les permissions**
    >   - Toute fonctionnalité disponible pour une structure sera contrôlée par une permission booléenne.
    >   - Le choix des permissions est disponible aussi directement depuis la page d'un partenaire. On  les appelle "permissions globales".
    >   - Si une structure est ajoutée, alors automatiquement, les droits de la structure seront ceux fixés dans la page du partenaire. Mais chaque permission de la structure restera activable ou désactivable.

- **Se connecter**
    >   - Si le partenaire est actif, alors il peut se connecter à l'aide de son adresse e-mail et du mot de passe. Il sera dirigé alors vers la plateforme où il pourra voir ses structures ainsi que les droits disponibles pour chacune d'entre elles.
    >   - Si la structure est active, alors elle pourra elle aussi se connecter à l'aide de ses identifiants. Elle pourra voir les modules disponibles (ou non) pour elle.

- **La notification par e-mail**
    - 2 types d'e-mails seront envoyés par l'application.
       ### Lorsqu'un partenaire a été créé :
       >    - Il recevra les informations permettant de se connecter.
       >    - Une demande de nouveau mot de passe sera demandée à la première connexion.
       ### Lorsqu'une structure a été créée :
       >    - Le gérant de la structure recevra les informations pour se connecter.
       >    - Une demande de nouveau mot de passe sera demandée à la première connexion.
       >    - Le partenaire reçoit un e-mail lui prévenant d'une nouvelle structure.
       ### Lorsqu'une ou plusieurs permissions ont été changées
       >    - Envoi d'e-mail à la structure et au partenaire, s'il s'agit d'une structure.
       >    - Envoi au partennaire, uniquement s'il s'agit d'une permission "globale"

- **La confirmation de sécurité**
    >   - À chaque modification ou suppression, l'application affiche un message demandant la confirmation de l'utilisateur.
    >   - S'il ne valide pas, alors l'action est annulée.

- **La recherche dynamique**
    >   - Une barre de recherche permet à l'utilisateur de trouver rapidement un partenaire en tapant les premières lettres de son nom.
    >   - Possibilité de trier la liste des partenaires ou structures afin de ne présenter que les éléments actifs ou désactivés.


## Installation en local

Cloner le projet

```bash
  git clone https://github.com/herveNkb/aqua-moov.git
```

Placer vous dans le répertoire du projet

```bash
  cd aqua-moov
```

Modifier le fichier.env selon votre environnement

Installez les dépendances avec composer

```bash
  composer install 
```

Créer et exécutez les migrations afin de récupérer la base de données

```bash
  php bin/console make:migration

  php bin/console doctrine:migration:migrate
```

Lancer le serveur de Symfony

```bash
  Symfony server:start
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
    git clone https://github.com/herveNkb/aqua-moov.git
```

9- Se placer dans le dossier /aqua-moov

```bash
    cd aqua-moov
```

10- Installer les dépendances

```bash
    composer install --no-dev --optimize-autoloader
```

11- Créer le fichier .env.local et le renseigner en passant les variables en production, et en renseignant les identifiants pour la base de données.

```bash
    cp .env .env.local

    nano .env.local

    APP_ENV=prod
    APP_DEBUG=0

    DATABASE_URL="mysql://NOM_UTILISATEUR:MOT_DE_PASSE@127.0.0.1:3306/nom_base_de_donnée?serverVersion=mariadb-10.3.36&charset=utf8mb4"
```

12- Créer la base de données si elle n'existe pas et faire une migration si nécessaire

```bash
    #Création de la BDD
    php bin/console doctrine:database:create

    #Création des tables
    php bin/console doctrine:schema:create

    #Faire la migration, si nécessaire
    php bin/console doctrine:migrations:migrate
```

13- Vider et réinitialiser les caches de l'application et du serveur

```bash
    php bin/console cache:clear

    php bin/console cache:warmup
```

# 📝 Un peu plus d'informations . . .




