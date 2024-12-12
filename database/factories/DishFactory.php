<?php

namespace Database\Factories;

use App\Models\Dish;
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
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Dish $dish) {
            if (!$dish->owner()->exists()) {
                $dish->owner()->associate(User::factory()->create());
            }
        });
    }

    // TODO: tu ne créé un utilisateur que lorsque cela n'est pas spécifié dans la factory Dish::factory()->has(User::factory())->create() --> tu créé 2 utilisateurs
    // TODO: passer par des 'hooks' "afterMaking" et regarder si pas déjà précisé
}
