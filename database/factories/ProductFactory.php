<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    //Factory classes generate model instances
    //Clasele Factory genereaza instante de model

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //The values assigned to generated class instance properties
        //Valorile atribuite propietatilor instantelor de clasa generate
        return [
            'name' => fake()->words(rand(1, 3), true),
            'description' => fake()->words(rand(3, 10), true),
            'price' => rand(1, 100),
            'quantity' => rand(1, 100)
        ];
    }
}