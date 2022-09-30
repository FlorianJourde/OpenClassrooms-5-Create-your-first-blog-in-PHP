<?php

namespace Application\Lib;

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

    public function isCurrentUser(int $user_id, int $current_user_id): bool
    {
        if ($user_id === $current_user_id) {
            return true;
        } else {
            return false;
        }
    }
}
