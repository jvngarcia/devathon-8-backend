<?php

/**
 * Labor Registration Controller
 *
 * PHP version 8
 *
 * @category Controller
 * @package  Controller\LaborRegistration
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Controllers;

use App\Http\Requests\LaborRegistrationRequest;
use App\Models\LaborRegistration;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * LaborRegistrationController
 *
 * @category Controller
 * @package  Controller\Status
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class LaborRegistrationController extends Controller
{
    /**
     * create a new labor registration
     *
     * @param  LaborRegistrationRequest $request request
     * @return JsonResponse response success response
     * 
     * @OA\Post(
     *      path="/v1/labor-registration",
     *      summary="Create a new labor registration",
     *      tags={"Labor-Registration"},
     *      @OA\Parameter(
     *          name="X-API-Key",
     *          in="header",
     *          description="API Key",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"image", "name", "email", "age", "address", "height"},
     *              @OA\Property(
     *                  property="image",
     *                  type="string",
     *                  format="binary",
     *                  example="image.jpg",
     *                  description="Image file"
     *              ),
     *              @OA\Property(
     *                property="name",
     *                type="string",
     *                example="John Doe",
     *                description="Name of the labor"
     *              ),
     *              @OA\Property(
     *                property="email",
     *                type="string",
     *                example="exampleexample.com",
     *                description="Email of the labor"
     *              ),
     *              @OA\Property(
     *                property="age",
     *                type="integer",
     *                example="25",
     *                description="Age of the labor"
     *              ),
     *              @OA\Property(
     *                property="address",
     *                type="string",
     *                example="1234 Main St",
     *                description="Address of the labor"
     *              ),
     *              @OA\Property(
     *                property="height",
     *                type="number",
     *                example="1.75",
     *                description="Height of the labor"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *        response=201,
     *        description="Labor registration created successfully",
     *        @OA\JsonContent(
     *          @OA\Property(
     *            property="message",
     *            type="string",
     *            example="Labor registration created successfully"
     *          ),
     *          @OA\Property(
     *            property="data",
     *            type="object",
     *            @OA\Property(
     *              property="image",
     *              type="string",
     *              example="http://localhost:8000/storage/image/image.jpg",
     *              description="Image of the labor"
     *            ),
     *            @OA\Property(
     *              property="name",
     *              type="string",
     *              example="John Doe",
     *              description="Name of the labor"
     *            ),
     *            @OA\Property(
     *              property="email",
     *              type="string",
     *              example="exampleexample.com",
     *              description="Email of the labor"
     *            ),
     *            @OA\Property(
     *              property="age",
     *              type="integer",
     *              example="25",
     *              description="Age of the labor"
     *            ),
     *            @OA\Property(
     *              property="address",
     *              type="string",
     *              example="1234 Main St",
     *              description="Address of the labor"
     *            ),
     *            @OA\Property(
     *              property="height",
     *              type="number",
     *              example="1.75",
     *              description="Height of the labor"
     *            )
     *          )
     *        )
     *      ),
     *      @OA\Response(
     *        response=422,
     *        description="Invalid data",
     *        @OA\JsonContent(
     *          @OA\Property(
     *            property="errors",
     *            type="object",
     *            @OA\Property(
     *              property="height",
     *              type="array",
     *              @OA\Items(
     *                type="string",
     *                example="The height must be a number."
     *              )
     *            ),
     *            @OA\Property(
     *              property="image",
     *              type="array",
     *              @OA\Items(
     *                type="string",
     *                example="The image must be an image.",
     *              )
     *            )
     *          )
     *        )
     *      )
     * )          
     */
    public function create(LaborRegistrationRequest $request): JsonResponse
    {
        $request->validated();

        $image = $request->file('image');
        $image->store('image/');

        $data = LaborRegistration::create([
            'image' => $image->hashName(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'age' => $request->input('age'),
            'address' => $request->input('address'),
            'height' => $request->input('height'),
        ]);

        $urlImage = url('storage/image/' . $image->hashName());

        return new JsonResponse([
            'message' => 'Labor registration created successfully',
            'data' => [
                'image' => $urlImage,
                'name' => $data->name,
                'email' => $data->email,
                'age' => $data->age,
                'address' => $data->address,
                'height' => $data->height,
            ]
        ], 201);
    }
}
