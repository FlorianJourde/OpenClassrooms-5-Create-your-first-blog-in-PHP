<?php

namespace Application\Lib;

use Application\Model\UserRepository;

class CheckUserRole
{
    public function isAdmin($user_role): bool
    {
        if ($user_role === 'Admin') {
            return true;
        } else {
            return false;
        }
    }

    public function isCurrentUser(int $userId, int $current_user_id): bool
    {
        if ($userId === $current_user_id) {
            return true;
        } else {
            return false;
        }
    }

    public function isAuthenticated(string $token): bool
    {
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        if ($userRepository->checkToken($token)) {
            return true;
        } else {
            return false;
        }
    }
}
