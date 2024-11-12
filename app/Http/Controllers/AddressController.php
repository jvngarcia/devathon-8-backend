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
use App\Exceptions\AddressAlreadyExistsException;
use App\Http\Resources\AddressCollection;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
     *     path="/api/addresses",
     *     summary="Create a new address",
     *     tags={"Addresses"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="place", type="string"),
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="country", type="string"),
     *             @OA\Property(property="coordinates", type="object",
     *                 @OA\Property(property="longitude", type="number", format="float", minimum=-180, maximum=180),
     *                 @OA\Property(property="latitude", type="number", format="float", minimum=-90, maximum=90)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Address created successfully",
     *         @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="data", type="object",
     *              @OA\Property(property="message", type="string", example="Address created successfully"),
     *              @OA\Property(property="address", type="object",
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="place", type="string", example="Example Place"),
     *                  @OA\Property(property="city", type="string", example="Example City"),
     *                  @OA\Property(property="country", type="string", example="Example Country"),
     *                  @OA\Property(property="coordinates", type="object",
     *                      @OA\Property(property="longitude", type="number", format="float", example=123.456),
     *                      @OA\Property(property="latitude", type="number", format="float", example=45.678)
     *                  )
     *          )
     *     )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'place' => 'required|string',
                'city' => 'required|string',
                'country' => 'required|string',
                'coordinates.longitude' => 'required|numeric|min:-180|max:180',
                'coordinates.latitude' => 'required|numeric|min:-90|max:90',
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'errors' => 'Invalid input data',
                    'details' => $e->errors()
                ],
                400
            );
        }


        if (Address::where('longitude', $validatedData['coordinates']['longitude'])
            ->where('latitude', $validatedData['coordinates']['latitude'])
            ->exists()
        ) {
            throw new AddressAlreadyExistsException();
        }

        $address = Address::create(
            [
                'place' => $validatedData['place'],
                'city' => $validatedData['city'],
                'country' => $validatedData['country'],
                'longitude' => $validatedData['coordinates']['longitude'],
                'latitude' => $validatedData['coordinates']['latitude']
            ]
        );

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
