# Comment configurer le projet

Assurez-vous de disposer de composer installer sur votre machine.
Lancez `composer install` afin de disposer de toutes les dépendances du projet

Le système de gestion de base de données que supporte le code de Kumaa est MySQL.
Pour configurer la base de donnée:
- Créer une base de donne MySQL
- Accorder les droits de lecture et de modification à cette base de donnée à un utilisateur MySQL
- Ajoutez un fichier `.env` dans le dossier config et configurez-le comme suit

```
DB_USERNAME = nom d'utilisateur mysql
DB_PSW = mot de passe utilisateur
DB_NAME = nom de la base de donnée
DB_HOST = adresse du SGBD ( généralement localhost )
```

- lancez la commande `./vendor/bin/phinx migrate` à la racine du dossier api
