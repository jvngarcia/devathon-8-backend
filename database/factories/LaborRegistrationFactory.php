<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaborRegistration>
 */
class LaborRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'image' => "https://picsum.photos/150/150?random=4",
            'email' => $this->faker->unique()->safeEmail,
            'age' => $this->faker->numberBetween(18, 60),
            'address' => $this->faker->address,
            'height' => $this->faker->randomFloat(2, 1, 2),
        ];
    }
}
