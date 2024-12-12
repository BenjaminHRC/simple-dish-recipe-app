<?php

namespace App\Events;

use App\Models\Dish;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DishCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Dish $dish)
    {
    }
} 