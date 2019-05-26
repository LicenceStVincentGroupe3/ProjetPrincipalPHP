# ProjetPrincipalPHP

## Auteurs

Dylan NOALLY, Dylan POPYK, Gradi MANDAMBU

Ce projet est un projet de fin d'année pour la Licence.

## Développement

La partie front-office sera développée en Angular version 7.0.
La partie back-office sera développée en Symfony version 4.1.

## Gestion des données

Utilisation de l'ORM Doctrine et du SGBD MySql.

## Besoin

Concevoir une application web métier appelée "Smart Leads" permettant de répondre à divers besoins de la direction commerciale et marketing que l'on ne retrouve pas dans la même application, ce qui justifie un développement spécifique qui propose les fonctionnalités suivantes :
- Disposer d'un outil métier centralisant les leads de toutes les équipes commerciales.
- Permettre aux commerciaux d'HAFA de gérer leur propre liste de contacts.
- Permettre à chaque commercial de qualifier ses contacts en vérifiant la validité des informations (email, téléphone, adresse, etc.)
- Permettre à la direction générale d'HAFA de regrouper tous les contacts et portefeuilles des commerciaux.
- Permettre aux commerciaux d'importer et d'exporter leurs contacts.
- Pouvoir créer des opérations marketing basées sur des templates (jeux concours, webinaires, évènements, avis client).
- L'application sera reliée à une API (Sendgrid, Mailjet) pour assurer le routage des emails et vérifier leurs validité.
- Pouvoir afficher un tableau de bord d'activité pour chauque commercial et un tableau de bord globale pour suivre la performance globale de l'équipe commerciale.

## Installation

Tout d'abord ouvrez l'invite de commande du système d'exploitation.

Afin de pouvoir utiliser l'application correctement, il est nécessaire d'installer :
- Composer qui est un environnement d'exécution de commande.
https://getcomposer.org/

- Yarn qui est un environnement d'exécution de commande.
https://yarnpkg.com/lang/en/
Pour les personnes possédants *NPM* : utilisez la commande *npm install -g yarn*.

```
Ensuite, allez dans le dossier **www** dans C: \ wamp64
```
$ cd c:wamp64/www
```
Ensuite exécutez cette commande pour cloner notre projet :
```
$ git clone git@github.com:LicenceStVincentGroupe3/ProjetPrincipalPHP.git
```

Une fois le projet cloné, accédez au dossier nouvellement créé intitulé "ProjetPrincipalPHP".
```
$ cd ProjetPrincipalPHP
```
Puis lancez ces commandes qui vont installer un package et tous les packages dont il dépend.
```
$ composer install
$ yarn install
```
Ensuite, executez les commandes de génération de base de données et des champs qui l'accompagnent.
```
$ php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```
Enfin, allumez le serveur qui ouvrira une page Web contenant notre projet
```
$ php bin/console server:run <> (Si jamais après cette commande le navigateur ne s'ouvre pas automatiquement, allez à l'URL suivante : http://127.0.0.1:8000)
```
Puis, lancez le package Webpack Encore qui gère les fichiers .css et .js.
```
$ yarn encore dev <> (Pour la première fois.)
$ yarn encore dev --watch <> (Pour toutes les fois suivante.)
```