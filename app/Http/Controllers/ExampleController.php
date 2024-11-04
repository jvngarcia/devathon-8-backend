<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Devathon 8: Team 1",
 *     version="0.1",
 * ),
 * @OA\Server(
 *      description="Localhost",
 *      url="http://localhost:8000/api/"
 *  ),
 */
class ExampleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/example",
     * @OA\Response(response=200, description="Successful operation"),
     *  )
     */
    public function index()
    {
        return response()->json(
            [
                'data' => [
                    [
                        'type' => 'example',
                        'id' => 1,
                        'attributes' => [
                            'title' => 'Lorem ipsum',
                        ]
                    ],[
                        'type' => 'example',
                        'id' => 2,
                        'attributes' => [
                            'title' => 'Lorem ipsum',
                        ]
                    ]
                ],
                "meta" => [
                    "total" => 2
                ]
            ]
        );

    }
}
