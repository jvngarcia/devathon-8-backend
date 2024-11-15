<?php
/**
 * AddressNotFoundException
 *
 * PHP version 8
 *
 * @category Exceptions
 * @package  Exceptions\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Address Not found exception
 *
 * @category Exceptions
 * @package  Exceptions\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class AddressNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @return JsonResponse $response Response instace
     */
    public function render(): JsonResponse
    {
        return response()->json(
            [
                'errors' => [
                    [
                        'status' => 404,
                        'title' => 'Not Found',
                        'detail' => 'Address not found.',
                    ],
                ],
            ],
            404
        );
    }
}
