<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'description' => $this->faker->paragraph(),
            'cuisine_type' => $this->faker->randomElement(['Italiana', 'Mexicana', 'China', 'Japonesa', 'Española', 'Francesa', 'India', 'Americana']),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'active' => $this->faker->boolean(80),
        ];
    }
}
