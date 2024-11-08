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

use App\Exceptions\AddressNotFoundException;
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
 */
class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * This method validates the incoming request data, checks if the address already exists, and creates a new address record if it does not.
     *
     * @param Request $request The incoming request containing the address data.
     * @return JsonResponse A JSON response indicating the success or failure of the address creation.
     * 
     * @OA\Post(
     *     path="/api/v1/addresses",
     *     summary="Create a new address",
     *     tags={"Addresses"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="longitude", type="number", format="float", example=12.3456),
     *             @OA\Property(property="latitude", type="number", format="float", example=56.7890),
     *             @OA\Property(property="place", type="string", example="Example Place"),
     *             @OA\Property(property="city", type="string", example="Example City"),
     *             @OA\Property(property="country", type="string", example="Example Country")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Address created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="longitude", type="number", format="float", example=12.3456),
     *             @OA\Property(property="latitude", type="number", format="float", example=56.7890),
     *             @OA\Property(property="place", type="string", example="Example Place"),
     *             @OA\Property(property="city", type="string", example="Example City"),
     *             @OA\Property(property="country", type="string", example="Example Country")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid request data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Address already exists",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Address already exists")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'longitude' => 'required|numeric|min:-180|max:180',
            'latitude' => 'required|numeric|min:-90|max:90',
            'place' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

        if (Address::where('place', $validatedData['place'])->where('city', $validatedData['city'])->where('country', $validatedData['country'])->exists()) {
            return response()->json(['error' => 'Address already exists'], 409);
        }

        $address = Address::create($validatedData);

        return response()->json([
            'message' => 'Address created successfully',
            'address' => $address
        ], 201);
    }

    /**
     * Get the last 5 addresses
     *
     * @return JsonResponse $data JsonResponse instance
     *
     * @OA\Get(
     *     path="/v1/addresses/recent",
     *     summary="Get the last 5 addresses",
     * @OA\Parameter(
     *         name="X-API-Key",
     *         in="header",
     *         description="API Key",
     * @OA\Schema(
     *             type="string"
     *         )
     *     ),
     * @OA\Response(response=200, description="Successful operation"),
     * @OA\Response(response=404, description="Not found"),
     * @OA\Response(response=401, description="Unauthorized"),
     *  )
     */
    public function show(): AddressCollection
    {
        $data = Address::orderBy('created_at', 'desc')->limit(5)->get();

        if ($data->isEmpty()) {
            throw new AddressNotFoundException();
        }

        return new AddressCollection($data);
    }
}
