<?php

namespace App\Policies;

use App\Models\Dish;
use App\Models\User;

class DishPolicy
{
    public function manage(User $user, ?Dish $dish = null): bool
    {
        return $user->is_admin;
    }
} 