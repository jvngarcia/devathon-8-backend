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

    public function testItShouldSearchBySender(): void
    {
        Letter::factory()->create(['sender' => 'John Doe']);
        Letter::factory()->create(['sender' => 'Jane Doe']);

        $response = $this->get('/api/v1/letters?search=John', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['sender' => 'John Doe']);
    }

    public function testItShouldSearchBySubject(): void
    {
        Letter::factory()->create(['subject' => 'Hello']);
        Letter::factory()->create(['subject' => 'World']);

        $response = $this->get('/api/v1/letters?search=Hello', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['subject' => 'Hello']);
    }

    public function testItShouldSearchByContent(): void
    {
        Letter::factory()->create(['content' => 'Hello World']);
        Letter::factory()->create(['content' => 'World Start']);

        $response = $this->get('/api/v1/letters?search=Hello', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['content' => 'Hello World']);
    }

    public function testItShouldSearchByCreatedAt(): void
    {
        Letter::factory()->create(['created_at' => '2021-01-01']);
        Letter::factory()->create(['created_at' => '2021-01-02']);

        $response = $this->get('/api/v1/letters?search=2021-01-01', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['created_at' => '2021-01-01T00:00:00.000000Z']);
    }

    public function testItShouldSearchByRead(): void
    {
        Letter::factory()->create(['read' => true]);
        Letter::factory()->create(['read' => false]);

        $response = $this->get('/api/v1/letters?status=read', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['read' => true]);
    }

    public function testItShouldSearchByStatusUnread(): void
    {
        Letter::factory()->create(['read' => true]);
        Letter::factory()->create(['read' => false]);

        $response = $this->get('/api/v1/letters?status=unread', ['X-API-Key' => $this->apiKey]);

        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['read' => false]);
    }

    public function testItShouldReturn404WhenNoSearchResult(): void
    {
        Letter::factory()->create(['sender' => 'John Doe']);
        Letter::factory()->create(['sender' => 'Jane Doe']);

        $response = $this->get('/api/v1/letters?search=Foo', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultByStatus(): void
    {
        Letter::factory()->create(['read' => true]);
        Letter::factory()->create(['read' => true]);

        $response = $this->get('/api/v1/letters?status=unread', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultByRead(): void
    {
        Letter::factory()->create(['read' => false]);
        Letter::factory()->create(['read' => false]);

        $response = $this->get('/api/v1/letters?status=read', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultByCreatedAt(): void
    {
        Letter::factory()->create(['created_at' => '2021-01-01']);
        Letter::factory()->create(['created_at' => '2021-01-02']);

        $response = $this->get('/api/v1/letters?search=2021-01-03', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultBySender(): void
    {
        Letter::factory()->create(['sender' => 'John Doe']);
        Letter::factory()->create(['sender' => 'Jane Doe']);

        $response = $this->get('/api/v1/letters?search=Foo', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultBySubject(): void
    {
        Letter::factory()->create(['subject' => 'Hello']);
        Letter::factory()->create(['subject' => 'World']);

        $response = $this->get('/api/v1/letters?search=Foo', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultByContent(): void
    {
        Letter::factory()->create(['content' => 'Hello World']);
        Letter::factory()->create(['content' => 'World Start']);

        $response = $this->get('/api/v1/letters?search=Foo', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultByStatusAndSearch(): void
    {
        Letter::factory()->create(['read' => true]);
        Letter::factory()->create(['read' => true]);

        $response = $this->get('/api/v1/letters?status=unread&search=Foo', ['X-API-Key' => $this->apiKey]);

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

    public function testItShouldReturn404WhenNoSearchResultByReadAndSearch(): void
    {
        Letter::factory()->create(['read' => false]);
        Letter::factory()->create(['read' => false, 'sender' => 'Jane Doe']);

        $response = $this->get('/api/v1/letters?status=read&search=Jane', ['X-API-Key' => $this->apiKey]);

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
}
