<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Letter>
 */
class LetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender' => $this->faker->name,
            'subject' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'read' => $this->faker->boolean,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
