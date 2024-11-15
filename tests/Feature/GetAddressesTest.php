<?php
/**
 * GetAddressesTest
 *
 * PHP version 8
 *
 * @category Testing
 * @package  Tests\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace Tests\Feature;

use App\Models\Address;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * Validate Get Addresses
 *
 * @category Testing
 * @package  Tests\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class GetAddressesTest extends TestCase
{
    /**
     * Success Full Request.
     *
     * @return void
     */
    public function testSuccessFullRequest(): void
    {
        Address::factory(100)->create();
        $response = $this->get(
            '/api/v1/addresses/recent',
            [ 'X-Api-Key' => env('API_KEY') ]
        );

        $response->assertStatus(200);
        Address::truncate();
    }

    /**
     * Get last 5 addresses.
     *
     * @return void
     */
    public function testGetLast5AddressesReturnsExpectedData(): void
    {
        Address::factory(100)->create();

        $response = $this->get(
            '/api/v1/addresses/recent',
            [ 'X-Api-Key' => env('API_KEY') ]
        );

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json
                ->has('data', 5)
                ->has('meta')
        );

        Address::truncate();
    }

    /**
     * Get last 5 addresses, when no addresses exits return 404.
     *
     * @return void
     */
    public function testGetLast5AddressesWhenNoAddressesExistsReturn404(): void
    {
        $response = $this->get(
            '/api/v1/addresses/recent',
            [ 'X-Api-Key' => env('API_KEY') ]
        );
        $response->assertStatus(404);
    }
}
