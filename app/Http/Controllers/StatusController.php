<?php
/**
 * StatusController
 *
 * PHP version 8
 *
 * @category Controller
 * @package  Controller\Status
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Status Controller
 *
 * @category Controller
 * @package  Controller\Status
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 *
 * @OA\Info(
 *     title="Devathon 8: Team 1",
 *     version="0.1",
 * ),
 * @OA\Server(
 *      description="Localhost",
 *      url="http://localhost:8000/api/"
 *  ),
 */
class StatusController extends Controller
{
    /**
     * Status API
     *
     * @return JsonResponse $response
     *
     * @OA\Get(
     *     path="/v1/status",
     *     summary="Status API",
     *      @OA\Parameter(
     *         name="X-API-Key",
     *         in="header",
     *         description="API Key",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=401, description="Unauthorized"),
     *  )
     */
    public function index(): JsonResponse
    {
        return response()->json(
            [
                "data" => [
                    [
                        "type" => "status",
                        "id" => 1,
                        "attributes" => [
                            "status" => "ok",
                        ]
                    ],
                ],
            ],
            200
        );
    }
}
