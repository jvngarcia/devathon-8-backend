<?php

 /**
 * LettersException
 *
 * PHP version 8
 *
 * @category Exceptions
 * @package  Exceptions\Letters
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Invalid Letter ID exception
 *
 * @category Exceptions
 * @package  Exceptions\Letters
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class InvalidLetterIdException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @return JsonResponse $response Response instace
     */
    public function render(): JsonResponse
    {
        return new JsonResponse(
            [
                'errors' => [
                    [
                        'status' => 406,
                        'title' => 'Invalid Id',
                        'detail' => 'Provided Id didn´t match standard.',
                    ],
                ],
            ],
            406
        );
    }
}
