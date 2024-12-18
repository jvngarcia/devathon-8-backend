<?php

/**
 * ToggleLettersReadTest
 *
 * PHP version 8
 *
 * @category Testing
 * @package  Tests\Letters
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Letter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Validate Put Letters
 *
 * @category Testing
 * @package  Tests\Letters
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class ToggleLettersReadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'X-Api-Key' => env('API_KEY'),
        ]);
    }

    /**
     * Tries to toggle a correct Id card.
     *
     * @return void
     */
    public function testCorrectId(): void
    {
        Letter::factory()->count(10)->create();
        $letter = Letter::factory()->create();

        $response = $this->put(
            "/api/v1/letter/$letter->id",
            ['X-Api-Key' => env('API_KEY')]
        );

        $response->assertStatus(200);
    }

    /**
     * Tries to toggle an incorrect Id card.
     *
     * @return void
     */
    public function testIncorrectId(): void
    {
        $response = $this->put(
            '/api/v1/letter/uno',
            ['X-Api-Key' => env('API_KEY')]
        );

        $response->assertStatus(406);
    }

    /**
     * Tries to toggle an unexisting Id card.
     *
     * @return void
     */
    public function testUnexistingId(): void
    {
        $response = $this->put(
            '/api/v1/letter/9999',
            ['X-Api-Key' => env('API_KEY')]
        );

        $response->assertStatus(404);
    }
}
