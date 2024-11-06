<?php
/**
 * EnsureApiKeyIsValid
 *
 * PHP version 8
 *
 * @category Middleware
 * @package  Middleware\ApiKey
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Validate API key middleware
 *
 * @category Middleware
 * @package  Middleware\ApiKey
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class EnsureApiKeyIsValid
{
    /**
     * Validate api key header.
     *
     * @param Request $request Request instance
     * @param Closure $next    Closure instance
     *
     * @return Response $response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey || $apiKey !== env('API_KEY')) {
            Log::error(
                'Unauthorized request.',
                [
                    'apiKey' => $apiKey,
                    'request' => $request->all(),
                    'headers' => $request->headers->all()
                ]
            );

            throw new UnauthorizedException();
        }

        return $next($request);
    }
}
