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

use App\Exceptions\LaborNotFoundException;
use App\Exceptions\InvalidIdException;
use App\Exceptions\LaborRegistrationNotFoundException;
use App\Http\Requests\LaborRegistrationRequest;
use App\Http\Requests\UpdateImageLaborRegistrationRequest;
use App\Http\Requests\UpdateLaborRegistrationRequest;
use App\Models\LaborRegistration;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * LaborRegistrationController
 *
 * @category Controller
 * @package  Controller\LaborRegistration
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

    /**
     * Retrieve a paginated list of labor registrations (elves).
     *
     * @param  \Illuminate\Http\Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse The paginated list of labor registrations.
     * 
     * @OA\Get(
     *     path="/v1/labor-registration/list",
     *     summary="Retrieve a paginated list of labor registrations (elves)",
     *     tags={"Labor-Registration"},
     *     @OA\Parameter(
     *          name="X-API-Key",
     *          in="header",
     *          description="API Key",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number to retrieve",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             example=1,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="image", type="string", example="http://localhost:8000/storage/image/image.jpg"),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="example@example.com"),
     *                     @OA\Property(property="age", type="integer", example=25),
     *                     @OA\Property(property="address", type="string", example="1234 Main St"),
     *                     @OA\Property(property="height", type="number", example=1.75),
     *                     @OA\Property(property="created_at", type="string", example="2023-05-01 12:00:00"),
     *                     @OA\Property(property="updated_at", type="string", example="2023-05-01 12:00:00"),
     *                     @OA\Property(property="id", type="integer", example=1)
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=50),
     *             @OA\Property(property="per_page", type="integer", example=20),
     *             @OA\Property(property="last_page", type="integer", example=3),
     *             @OA\Property(property="next_page_url", type="string", example="http://localhost:8000/api/v1/labor-registration/list?page=2")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="status",
     *                     type="integer",
     *                     example=404
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Not Found"
     *                 ),
     *                 @OA\Property(
     *                     property="detail",
     *                     type="string",
     *                     example="Resource not found."
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="page",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The page field must be an integer and at least 1."
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'paginate' => 'integer|min:1',
        ]);

        $query = LaborRegistration::query();

        if ($request->has("search")) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has("order") && $request->has("direction")) {
            $query->orderBy($request->order, $request->direction);
        }

        $data = $query->paginate($request->paginate);

        if ($data->isEmpty()) {
            return response()->json([], 200);
        }

        $currentPage = $request->query('page', 1);
        if ($currentPage > $data->lastPage()) {
            return response()->json([], 200);
        }

        foreach ($data as $key => $value) {
            if (strpos($value->image, 'http') === 0) {
                continue;
            }
            $urlImage = url('storage/image/' . $value->image);
            $data[$key]->image = $urlImage;
        }

        return response()->json($data, 200);
    }


    /**
     * Retrieve a labor registrations (elves).
     *
     * @param  int $id The id of the labor registration.
     * @return \Illuminate\Http\JsonResponse The paginated list of labor registrations.
     * 
     * @OA\Get(
     *     path="/v1/labor-registration/{id}",
     *     summary="Retrieve a labor registrations (elves)",
     *     tags={"Labor-Registration"},
     *     @OA\Parameter(
     *          name="X-API-Key",
     *          in="header",
     *          description="API Key",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the labor registration",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="image", type="string", example="http://localhost:8000/storage/image/image.jpg"),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="example@example.com"),
     *                     @OA\Property(property="age", type="integer", example=25),
     *                     @OA\Property(property="address", type="string", example="1234 Main St"),
     *                     @OA\Property(property="height", type="number", example=1.75),
     *                     @OA\Property(property="created_at", type="string", example="2023-05-01 12:00:00"),
     *                     @OA\Property(property="updated_at", type="string", example="2023-05-01 12:00:00"),
     *                     @OA\Property(property="id", type="integer", example=1)
     *                 )
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="status",
     *                     type="integer",
     *                     example=404
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Not Found"
     *                 ),
     *                 @OA\Property(
     *                     property="detail",
     *                     type="string",
     *                     example="Resource not found."
     *                 )
     *             )
     *          )
     *     ),
     *     @OA\Response(
     *         response=406,
     *         description="Invalid ID",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="integer", example=406),
     *                     @OA\Property(property="title", type="string", example="Invalid Id"),
     *                     @OA\Property(property="detail", type="string", example="Provided Id didn’t match standard.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        if (!is_numeric($id) && $id < 1) {
            throw new InvalidIdException();
        }

        $data = LaborRegistration::find($id);

        if (!$data) {
            throw new LaborRegistrationNotFoundException();
        }

        $urlImage = url('storage/image/' . $data->image);

        return response()->json([
            'data' => [
                [
                    'image' => $urlImage,
                    'name' => $data->name,
                    'email' => $data->email,
                    'age' => $data->age,
                    'address' => $data->address,
                    'height' => $data->height,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                    'id' => $data->id,
                ]
            ]
        ], 200);
    }


    /**
     * @OA\Delete(
     *     path="/labor-registration/{id}",
     *     summary="Delete a labor registration",
     *     description="Deletes a labor registration by its ID. Throws an error if the ID is invalid or the resource does not exist.",
     *     operationId="deleteLaborRegistration",
     *     tags={"Labor-Registration"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the labor registration to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Labor registration deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Elf successfully deleted."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     example="http://localhost:8000/storage/image/image.jpg",
     *                     description="Image of the labor"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="John Doe",
     *                     description="Name of the labor"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="example@example.com",
     *                     description="Email of the labor"
     *                 ),
     *                 @OA\Property(
     *                     property="age",
     *                     type="integer",
     *                     example=25,
     *                     description="Age of the labor"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string",
     *                     example="1234 Main St",
     *                     description="Address of the labor"
     *                 ),
     *                 @OA\Property(
     *                     property="height",
     *                     type="number",
     *                     example=1.75,
     *                     description="Height of the labor"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Labor registration not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="integer", example=404),
     *                     @OA\Property(property="title", type="string", example="Not Found"),
     *                     @OA\Property(property="detail", type="string", example="Elf not found.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=406,
     *         description="Invalid ID",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="integer", example=406),
     *                     @OA\Property(property="title", type="string", example="Invalid Id"),
     *                     @OA\Property(property="detail", type="string", example="Provided Id didn’t match standard.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        if (!is_numeric($id)) {
            throw new InvalidIdException();
        }

        $data = LaborRegistration::find($id);

        if (!$data) {
            throw new LaborRegistrationNotFoundException();
        }


        if (is_null($data)) {
            throw new LaborNotFoundException();
        }

        $data->delete();

        return response()->json([
            'message' => 'Elf successfully deleted.',
            'data' => $data
        ], 200);
    }

    /**
     * Update labor registration
     *
     * @param  LaborRegistrationRequest $request request
     * @return JsonResponse response success response
     * 
     * @OA\Put(
     *      path="/v1/labor-registration/{id}",
     *      summary="Update labor registration",
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
     *        response=200,
     *        description="Elf updated successfully",
     *        @OA\JsonContent(
     *          @OA\Property(
     *            property="message",
     *            type="string",
     *            example="Elf updated successfully"
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
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Unauthorized"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *        response=404,
     *        description="Elf not found",
     *        @OA\JsonContent(
     *          @OA\Property(
     *            property="message",
     *            type="string",
     *            example="Elf not found"
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
    public function update(UpdateLaborRegistrationRequest $request, string $id): JsonResponse
    {
        $request->validated();
        $elf = LaborRegistration::find($id);

        if (!$elf) {
            throw new LaborNotFoundException();
        }

        $elf->update(
            $request->only(['name', 'email', 'age', 'address', 'height'])
        );
        $elf->save();

        $urlImage = url('storage/image/' . $elf->image);

        return new JsonResponse([
            'message' => 'Elf updated successfully.',
            'data' => [
                'image' => $urlImage,
                'name' => $elf->name,
                'email' => $elf->email,
                'age' => $elf->age,
                'address' => $elf->address,
                'height' => $elf->height,
            ]
        ], 200, ['message' => 'Elf updated successfully.']);
    }

    /** 
     * Update image of labor registration
     * 
     * @param UpdateImageLaborRegistrationRequest $request request
     * @param string $id id
     * 
     * @return JsonResponse response success response
     * 
     * @OA\Post(
     *   path="/v1/labor-registration/{id}",
     *   summary="Update image of labor registration",  
     *   tags={"Labor-Registration"},
     *   @OA\Parameter(
     *     name="X-API-Key",
     *     in="header",
     *     description="API Key",
     *     @OA\Schema(
     *       type="string"
     *     ),
     *     required=true
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         required={"image"},
     *         @OA\Property(
     *           property="image",
     *           type="string",
     *           format="binary",
     *           example="image.jpg",
     *           description="Image file"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *        response=200,
     *        description="Elf updated successfully",
     *        @OA\JsonContent(
     *          @OA\Property(
     *            property="message",
     *            type="string",
     *            example="Elf updated successfully"
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
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Unauthorized"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *        response=404,
     *        description="Elf not found",
     *        @OA\JsonContent(
     *          @OA\Property(
     *            property="message",
     *            type="string",
     *            example="Elf not found"
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
     *   )
     *       
     */
    public function updateImage(UpdateImageLaborRegistrationRequest $request, string $id)
    {
        $request->validated();
        $elf = LaborRegistration::find($id);

        if (!$elf) {
            throw new LaborNotFoundException();
        }

        $image = $request->file('image');
        $image->store('image/');

        $elf->image = $image->hashName();
        $elf->save();

        $urlImage = url('storage/image/' . $elf->image);

        return new JsonResponse([
            'message' => 'Elf updated successfully.',
            'data' => [
                'image' => $urlImage,
                'name' => $elf->name,
                'email' => $elf->email,
                'age' => $elf->age,
                'address' => $elf->address,
                'height' => $elf->height,
            ]
        ], 200, ['message' => 'Elf updated successfully.']);
    }
}
