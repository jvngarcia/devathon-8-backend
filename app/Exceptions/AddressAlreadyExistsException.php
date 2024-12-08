<?php

/**
 * AddressAlreadyExistsException
 * 
 * PHP version 8
 * 
 * @category Exceptions
 * @package  Exceptions\Address
 * @author   Darío Jesús Ramírez Romero <dariojesusramirez@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * AddressAlreadyExistsException
 * 
 * @category Exceptions
 * @package  Exceptions\Address
 * @author   Darío Jesús Ramírez Romero <dariojesusramirez@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class AddressAlreadyExistsException extends Exception
{
  /**
   * Render the exception as an HTTP response.
   *
   * @return Json
   */
  public function render(): JsonResponse
  {
    return response()->json(
      [
        'errors' => [
          [
            'status' => 422,
            'title' => 'Unprocessable Entity',
            'detail' => 'Address already exists.',
          ],
        ],
      ],
      422
    );
  }
}
