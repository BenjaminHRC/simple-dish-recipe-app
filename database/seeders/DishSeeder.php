<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dish::factory(250)
            ->create()
            ->each(function ($dish) {
                $dish->users()
                    ->attach(User::inRandomOrder()->limit(rand(1, 50))->pluck('id')->toArray());
            });
    }
}
