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
    /**
     * Tries to toggle a correct Id card.
     *
     * @return void
     */
    public function testIncorrectId(): void
    {
        $response = $this->get(
            '/api/v1/letter/1',
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
        $response = $this->get(
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
    public function testIncorrectId(): void
    {
        $response = $this->get(
            '/api/v1/letter/9999',
            ['X-Api-Key' => env('API_KEY')]
        );

        $response->assertStatus(404);
    }
}