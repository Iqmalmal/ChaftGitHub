<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->sentence(),
            'tags' => 'Toys, Hobby, Clothes, Electronics, Books, Games, Collectibles, Automotive',
            'seller' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'price' => $this->faker->randomNumber(5,1000),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
