<?php

namespace Tests\Feature;

use App\Models\LaborRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateLaborRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'X-Api-Key' => env('API_KEY'),
        ]);
    }

    public function testItShouldUpdateLaborRegistration(): void
    {
        $labor = LaborRegistration::factory()->create();


        $response = $this->putJson(route('labor-registration.update', ['id' => $labor->id]), [
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'age' => 25,
            'address' => '1234 Main St',
            'height' => 1.75,
        ]);

        $response->assertStatus(200)
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

    public function testItShouldNotUpdateLaborRegistrationWithInvalidData(): void
    {
        $labor = LaborRegistration::factory()->create();


        $response = $this->putJson(route('labor-registration.update', ['id' => $labor->id]), [
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'age' => 25,
            'address' => '1234 Main St',
            'height' => 'invalid_height',
        ]);

        $response->assertStatus(422);
    }
}
