#Site vitrine BTP

##Objectif : Créer un nouveau site vitrine pour une société de BTP, avec une interface administrateur simple.

##Outils utilisés :
    PHP 7.2.5
    Framework Symfony 5.1
    Composer
    //Yarn
   
##Installation:
    composer install
    //yarn install//
    //php bin/console assets:install public//
    //yarn build//
    php bin/console doctrine:database:drop --force
    php bin/console doctrine:database:CREATE
    php bin/console doctrine:migrations:migrate
    php bin/console d:s:u --force
    php bin/console doctrine:fixtures:load

##Bundles utilisés :
    Webpack-encore
    Swiftmailer
    Voter

##Liste des fonctions opérationnelles : 
  ###Côté Administration :
    Accès à la partie administrateur (sans que cela apparaisse côté utilisateur)
        via -> /admin
    Création de formulaire pour le contenu statique.
    Création de formulaire pour la gestion des fichiers uploadés.

  ###Côté utilisateur :
    formulaire de contact + visuel en une seul page.

##Nous avons généré sur l’ensemble du contenu statique des fixtures, peut être modifié après installation.
