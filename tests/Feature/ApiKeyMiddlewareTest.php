<?php
/**
 * ApiKeyMiddlewareTest
 *
 * PHP version 8
 *
 * @category Testing
 * @package  Tests\Feature
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * Validate API key middleware
 *
 * @category Testing
 * @package  Tests\Feature
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class ApiKeyMiddlewareTest extends TestCase
{
    /**
     * Validate api key required
     *
     * @return void
     */
    public function testApiKeyIsEmpty(): void
    {
        $response = $this->get('/api/v1/status');
        $response->assertStatus(401);
    }

    /**
     * Validate api key must be valid
     *
     * @return void
     */
    public function testApiKeyIsInvalid(): void
    {
        $response = $this->get(
            '/api/v1/status',
            [
                'X-API-Key' => 'invalid key',
            ]
        );

        $response->assertStatus(401);
    }

    /**
     * Validate api key is valid
     *
     * @return void
     */
    public function testApiKeyIsValid(): void
    {
        $response = $this->get(
            '/api/v1/status',
            [
                'X-API-Key' => env('API_KEY'),
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * Validate json response
     *
     * @return void
     */
    public function testValidateJsonResponse(): void
    {
        $response = $this->get(
            '/api/v1/status',
            [
                'X-API-Key' => 'invalid key',
            ]
        );

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->has('errors', 1)
                ->has(
                    'errors.0',
                    fn (AssertableJson $json) => $json
                        ->where('status', 401)
                        ->where('title', 'Unauthorized')
                        ->where('detail', 'API key is invalid.')
                )
        );

        $response->assertStatus(401);

    }
}
