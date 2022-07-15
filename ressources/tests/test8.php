<?php

declare(strict_types=1);

class User
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public static $nombreUtilisateursInitialisés = 0;

    public function __construct(public string $username, public string $status = self::STATUS_ACTIVE)
    {
    }

    public function printStatus()
    {
        echo $this->status;
    }
}

class Admin extends User
{
    public static $nombreAdminInitialisés = 0;

    // mise à jour des valeurs des propriétés statiques de la classe courante avec `self`, et de la classe parente avec `parent`
    public static function nouvelleInitialisation()
    {
        self::$nombreAdminInitialisés++; // classe Admin
        parent::$nombreUtilisateursInitialisés++; // classe User
    }

    public function printCustomStatus()
    {
        echo "L’administrateur {$this->username} a pour statut : ";
        $this->printStatus(); // on appelle printStatus du parent depuis la classe enfant
    }
}

var_dump(User::$nombreUtilisateursInitialisés);

Admin::nouvelleInitialisation();

var_dump(Admin::$nombreAdminInitialisés, Admin::$nombreUtilisateursInitialisés, User::$nombreUtilisateursInitialisés);
//var_dump(User::$nombreAdminInitialisés); // ceci ne marche pas.

$admin = new Admin('Lily');
$admin->printCustomStatus(); // Affiche “L’administrateur Lily a pour statut : active”
//$admin->printStatus(); // printStatus n’existe pas dans la classe Admin, donc printStatus de la classe User sera appelée grâce à l’héritage