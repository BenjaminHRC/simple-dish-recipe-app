<?php

namespace App\Observers;

use App\Models\Dish;

class DishObserver
{
    /**
     * Handle the Dish "deleted" event.
     */
    public function deleted(Dish $dish): void
    {
        $dish->users()->detach();
    }
} 