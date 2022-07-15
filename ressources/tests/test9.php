<?php

declare(strict_types=1);

class User
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public function __construct(public string $username, public string $status = self::STATUS_ACTIVE)
    {
    }

public function setStatus(string $status): void
{
    if (!in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
        trigger_error(sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE])), E_USER_ERROR);
    };

    $this->status = $status;
}

public function getStatus(): string
{
    return $this->status;
}
}

class Admin extends User
{
    public const STATUS_LOCKED = 'locked';

    // la méthode est entièrement réécrite ici :) seule la signature reste inchangée
    public function setStatus(string $status): void
    {
        if (!in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_LOCKED])) {
            trigger_error(sprintf('Le status %s n\'est pas valide. Les status possibles sont : %s', $status, implode(', ', [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_LOCKED])), E_USER_ERROR);
        };

        $this->status = $status;
    }

    // la méthode utilisée est celle de la classe parente, puis ajoute un comportement :)
    public function getStatus(): string
    {
        return strtoupper(parent::getStatus());
    }
}

$user = new User('Wellington');
$admin = new Admin('Paddington');
echo $user->getStatus();
echo $admin->getStatus();
$admin->setStatus(Admin::STATUS_LOCKED);
echo $admin->getStatus();
