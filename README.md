# OpenClassrooms
- Développeur d'application
- PHP/Symfony - Projet 5

## Créez votre premier blog en PHP

![OpenClassrooms banneer](./public/ressources/images/readme-header.jpg)

### À propos

Bonjour est bienvenu sur le dépôt de mon travail concernant le cinquième projet d'OpenClassrooms, intutulé "Créez votre premier blog en PHP" ! Vous trouverez, ci-après, la procédure d'installation pour prendre en main le code, ainsi que la base de données et sa structure, conçue pour fonctionner avec.

Vous trouverez également, dans les dossiers "diagrams", ainsi que "review", les autres livrables requis pour la validation de ce projet.

[![Preview site](https://img.shields.io/badge/Preview%20site--89bf54?style=for-the-badge&logo=InternetExplorer&logoColor=white)](https://florianjourde.com/)

**PHP • Twig • JS • CSS • MVC • POO**

---


## Remarque

Pour pouvoir installer ce projet, Composer doit être présent sur votre machine, ainsi qu'un serveur local. Si vous ne disposez pas de ces outils, vous pourrez les télécharger et installer, en suivant ces liens :
- Télécharger [Composer](https://getcomposer.org/)
- Télécharger [Wamp](https://www.wampserver.com/) (Windows)
- Télécharger [Mamp](https://www.wampserver.com/) (Mamp)

---

## Installation

1. À l'aide dans terminal, créer et rendez-vous dans le répertoire d'installation souhaité pour le projet, et lancez la commande suivante :
```shell
git clone https://github.com/FlorianJourde/OpenClassrooms-5-Create-your-first-blog-in-PHP.git
```



2. À la racine de ce répertoire, lancez la commande suivante pour installer les dépendances Composer :
```shell
composer install
```

3. Vous devez maintenant modifier le fichier `DatabaseConnection.php` situé dans `\5-Blog-en-PHP\src\lib\DatabaseConnection.php`. Remplacer `username`, `password`, ainsi qu'éventuellement `localhost` par vos identifiants de base de données locale :
```php
<?php

namespace Application\Lib;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=florianjourde;charset=utf8', 'username', 'password');
        }

        return $this->database;
    }
}
```

4. Pour terminer, importer simplement le fichier `florianjourde.sql` à la racine du projet dans votre base de données locale. Si les informations ont correctement été renseignées, la connexion devrait pouvoir se faire sans problèmes.

5. Pour pouvoir tester les controllers, veuillez utiliser les identifiants par défaut :
- Admin
    - ID : admin@admin.com
    - MDP : 123456
- User
    - ID : user@user.com
    - MDP : 123456
    
6. Si vous souhaitez pouvoir tester les emails directement depuis votre serveur local, il sera nécessaire d'utiliser [Fake Sendmail](https://www.glob.com.au/sendmail/). Je vous invite à suivre ce tutoriel, qui vous indiquera la procédure à suivre :
- [Grafikart](https://grafikart.fr/blog/mail-local-wamp)

Veuillez préter attention au second commentaire, laissé par `hamza.essamami.sio@gmail.com`, si vous utilisez Gmail et que vous rencontrez des problèmes de connexion au service.