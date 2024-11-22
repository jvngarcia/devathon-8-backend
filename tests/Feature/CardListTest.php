<?php

namespace Tests\Feature;

use App\Models\Letter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardListTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiKey;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiKey = env('API_KEY');
    }

    public function testItShouldReturnSuccessResponse(): void
    {
        Letter::factory(40)->create();
        $response = $this->get('/api/v1/letters', ['X-API-Key' => $this->apiKey]);

        $response->assertStatus(200);
    }

    public function testItShouldReturn20Items(): void
    {
        Letter::factory(40)->create();
        $response = $this->get('/api/v1/letters', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(20, 'data');
    }

    public function testItShouldJsonapiFormat(): void
    {
        Letter::factory(40)->create();
        $response = $this->get('/api/v1/letters', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'type',
                    'id',
                    'attributes' => [
                        'sender',
                        'subject',
                        'content',
                        'read',
                        'image',
                        'created_at',
                    ],
                ],
            ],
            'meta' => [
                'total',
            ],
            'links' => [
                'self',
            ],
        ]);
    }

    public function testItShouldReturn404WhenNoLettersExists(): void
    {
        $response = $this->get('/api/v1/letters', ['X-API-Key' => $this->apiKey]);

        $response->assertStatus(404);
        $response->assertJsonStructure([
            'errors' => [
                '*' => [
                    'status',
                    'title',
                    'detail',
                ],
            ],
        ]);
    }

    public function testItShouldReturn401WhenNoApiKey(): void
    {
        $response = $this->get('/api/v1/letters');
        $response->assertStatus(401);
    }
}
