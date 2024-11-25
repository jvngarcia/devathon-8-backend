<?php

namespace Tests\Feature\LaborRegistration;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RegisterLaborRegistrationTest extends TestCase
{
    use RefreshDatabase;

    private $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'X-Api-Key' => env('API_KEY'),
        ]);

        $this->faker = Factory::create();;
    }

    public function testItShouldRegisterLaborRegistration(): void
    {

        $imageJPG = UploadedFile::fake()->image('image.jpg', 640, 480, 'image/jpeg');

        $response = $this->postJson(route('labor-registration.create'), [
            'image' => $imageJPG,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'age' => $this->faker->numberBetween(18, 65),
            'address' => $this->faker->address,
            'height' => $this->faker->randomFloat(2, 1, 2),
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'image',
                    'name',
                    'email',
                    'age',
                    'address',
                    'height',
                ],
            ]);
    }

    public function testItShouldNotRegisterLaborRegistrationWithInvalidData(): void
    {
        $imageJPG = UploadedFile::fake()->image('image.jpg', 640, 480, 'image/jpeg');

        $response = $this->postJson(route('labor-registration.create'), [
            'image' => $imageJPG,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'age' => $this->faker->numberBetween(18, 65),
            'address' => $this->faker->address,
            'height' => 'invalid_height',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'height',
                ],
            ]);
    }

    public function testItShouldNotRegisterLaborRegistrationWithInvalidImage(): void
    {
        $response = $this->postJson(route('labor-registration.create'), [
            'image' => 'invalid_image',
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'age' => $this->faker->numberBetween(18, 65),
            'address' => $this->faker->address,
            'height' => $this->faker->randomFloat(2, 1, 2),
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'image',
                ],
            ]);
    }
}
