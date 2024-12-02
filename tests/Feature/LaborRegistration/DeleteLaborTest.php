<?php

namespace Tests\Feature;

use App\Models\LaborRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteLaborTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'X-Api-Key' => env('API_KEY'),
        ]);
    }

    public function testItShouldDeleteLaborRegistration(): void
    {
        LaborRegistration::factory()->count(10)->create();

        $response = $this->delete(
            '/api/v1/labor-registration/1'
        );

        $response->assertStatus(200);
    }

    public function testItShouldNotDeleteLaborRegistrationWithInvalidId(): void
    {
        LaborRegistration::factory()->count(10)->create();

        $response = $this->delete(
            '/api/v1/labor-registration/uno'
        );

        $response->assertStatus(406);
    }

    public function testItShouldNotDeleteLaborRegistrationWithNotExistingId(): void
    {
        LaborRegistration::factory()->count(10)->create();

        $response = $this->delete(
            '/api/v1/labor-registration/9999'
        );

        $response->assertStatus(404);
    }
}