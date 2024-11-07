<?php
/**
 * Address Controller
 *
 * PHP version 8
 *
 * @category Controller
 * @package  Controller\Address
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Controllers;

use App\Http\Resources\AddressCollection;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Address Controller
 *
 * @category Controller
 * @package  Controller\Address
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
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
 * ),
 */
class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Get the last 5 addresses
     *
     * @return JsonResponse $data JsonResponse instance
     *
     * @OA\Get(
     *     path="/v1/addresses/recent",
     *     summary="Get the last 5 addresses",
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=401, description="Unauthorized"),
     *  )
     */
    public function show(): AddressCollection
    {
        return new AddressCollection(Address::orderBy('created_at', 'desc')->limit(4)->get());
    }
}
