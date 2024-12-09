<?php

namespace Tests\Feature;

use App\Models\LaborRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LaborRegistrationListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful retrieval of labor registration list.
     * 
     * @return void
     */

    public function testCanRetrievePaginatedLaborRegistrationList(): void
    {
        LaborRegistration::factory()->count(25)->create();

        $response = $this->get(
            '/api/v1/labor-registration/list?paginate=20',
            ['X-Api-Key' => env('API_KEY'),]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'age',
                    'address',
                    'height',
                    'image',
                    'created_at',
                    'updated_at',
                ],
            ],
            'current_page',
            'total',
            'per_page',
            'last_page',
            'next_page_url',
        ]);

        $this->assertCount(20, $response->json('data'));
    }

    /**
     * Test when there are no labor registrations in the database.
     * 
     * @return void
     */

    public function testReturns404WhenNoLaborRegistrationsExist(): void
    {
        $response = $this->get(
            '/api/v1/labor-registration/list',
            ['X-Api-Key' => env('API_KEY'),]
        );

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors' => [
                [
                    'status',
                    'title',
                    'detail'
                ],
            ],
        ]);
    }

    public function testItShouldSearchAndReturnLaborRegistration(): void
    {
        $laborRegistration = LaborRegistration::factory()->create();

        $response = $this->get(
            '/api/v1/labor-registration/list?paginate=20&search=' . $laborRegistration->name,
            ['X-Api-Key' => env('API_KEY'),]
        );

        $response->assertStatus(200);

        $response->assertJsonFragment(
            [
                'name' => $laborRegistration->name,
            ]
        );
    }

    public function testItShouldReturn404WhenNoLaborRegistrationIsFound(): void
    {
        $response = $this->get(
            '/api/v1/labor-registration/list?paginate=20&search=non-existent-labor-registration',
            ['X-Api-Key' => env('API_KEY'),]
        );

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'errors' => [
                [
                    'status',
                    'title',
                    'detail',
                ],
            ],
        ]);
    }

    public function testItShouldOrderByAge(): void
    {
        LaborRegistration::factory()->create([
            'age' => 20,
        ]);

        LaborRegistration::factory()->create([
            'age' => 30,
        ]);

        $response = $this->get(
            '/api/v1/labor-registration/list?paginate=20&order_by=age&order=asc',
            ['X-Api-Key' => env('API_KEY'),]
        );

        $response->assertStatus(200);

        $response->assertJsonFragment(
            [
                'age' => 20,
            ]
        );

        $response->assertJsonFragment(
            [
                'age' => 30,
            ]
        );
    }

    public function testItShouldOrderByHeight(): void
    {
        LaborRegistration::factory()->create([
            'height' => 1.70,
        ]);

        LaborRegistration::factory()->create([
            'height' => 1.80,
        ]);

        $response = $this->get(
            '/api/v1/labor-registration/list?paginate=20&order=height&direction=asc',
            ['X-Api-Key' => env('API_KEY'),]
        );

        $response->assertStatus(200);

        $response->assertJsonFragment(
            [
                'height' => 1.70,
            ]
        );

        $response->assertJsonFragment(
            [
                'height' => 1.80,
            ]
        );
    }
}
