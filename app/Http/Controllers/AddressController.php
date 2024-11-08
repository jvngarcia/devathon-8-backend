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
            return response()->json(['error' => 'Address already exists'], 400);
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
