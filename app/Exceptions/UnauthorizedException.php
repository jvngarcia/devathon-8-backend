<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
