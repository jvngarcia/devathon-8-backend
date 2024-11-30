<?php

/**
 * LaborRegistrationNotFoundException
 * 
 * PHP version 8
 * 
 * @category Exceptions
 * @package  Exceptions\LaborRegistration
 * @author   Darío Jesús Ramírez Romero <dariojesusramirez@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 * 
 * */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class LaborRegistrationNotFoundException extends Exception
{
  /**
   * Render the exception as an HTTP response.
   *
   * @return JsonResponse
   */
  public function render(): JsonResponse
  {
    return response()->json(
      [
        'errors' => [
          [
            'status' => 404,
            'title' => 'Not Found',
            'detail' => 'No elves found.',
          ],
        ],
      ],
      404
    );
  }
}
