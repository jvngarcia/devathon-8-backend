<?php

namespace Tests\Feature\LaborRegistration;

use App\Models\LaborRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowLaborRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'X-Api-Key' => env('API_KEY'),
        ]);
    }

    public function testItShouldReturnLaborRegistration()
    {
        $labor = LaborRegistration::factory()->create();

        $response = $this->getJson(route('labor-registration.show', ['id' => $labor->id]));

        $response->assertStatus(200);
    }

    public function testItShouldReturn404WhenLaborRegistrationNotFound()
    {
        $response = $this->getJson(route('labor-registration.show', ['id' => 1]));

        $response->assertStatus(404);
    }

    public function testItShouldReturn404WhenLaborRegistrationNotFoundWithCustomMessage()
    {
        $response = $this->getJson(route('labor-registration.show', ['id' => 1]));

        $response->assertJson([
            'errors' => [
                [
                    'status' => 404,
                    'title' => 'Not Found',
                    'detail' => 'No elves found.',
                ],
            ],
        ]);
    }

    public function testItShouldReturn404WhenIdIsInvalid()
    {
        $response = $this->getJson(route('labor-registration.show', ['id' => 'invalid']));

        $response->assertStatus(404);
    }
}
