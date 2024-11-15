<?php
/**
 * UnauthorizedException
 *
 * PHP version 8
 *
 * @category Exceptions
 * @package  Exceptions\Auth
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Unauthorized exception
 *
 * @category Exceptions
 * @package  Exceptions\Auth
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class UnauthorizedException extends Exception
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
                        'status' => 401,
                        'title' => 'Unauthorized',
                        'detail' => 'API key is invalid.',
                    ],
                ],
            ],
            401
        );
    }
}
