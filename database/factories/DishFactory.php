<?php

namespace Database\Factories;

use App\Models\User;
use FakerRestaurant\Provider\fr_FR\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as NativeFaker;
use Xvladqt\Faker\LoremFlickrProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerDishName = NativeFaker::create();
        $fakerDishName->addProvider(new Restaurant($fakerDishName));
        $fakerDishImage = NativeFaker::create();
        $fakerDishImage->addProvider(new LoremFlickrProvider($fakerDishImage));

        return [
            'name' => $fakerDishName->foodName(),
            'recette' => fake()->text(),
            'image' => $fakerDishImage->imageUrl(640, 480, ['dish']),
            'user_id' => User::factory(),
        ];
    }
}
