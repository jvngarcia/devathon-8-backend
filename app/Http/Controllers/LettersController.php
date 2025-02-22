<?php

/**
 * Letters Controller
 *
 * PHP version 8
 *
 * @category Controller
 * @package  Controller\Letters
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Controllers;

use App\Exceptions\LettersNotFoundException;
use App\Exceptions\InvalidIdException;
use App\Http\Resources\LettersCollection;
use App\Models\Letter;
use Illuminate\Http\Request;

/**
 * Letters Controller
 *
 * @category Controller
 * @package  Controller\Letters
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class LettersController extends Controller
{
    /**
     * Display a listing of the letters.
     * 
     * @param Request $request Request
     * 
     * @return LettersCollection $data Collection of letters
     * 
     * @OA\Get(
     *      path="/v1/letters",
     *      summary="List and obtain letters ",
     *      tags={"Letters"},
     *      @OA\Parameter(
     *          name="X-API-Key",
     *          in="header",
     *          description="API Key",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          description="Filter by read status",
     *          required=false,
     *          @OA\Schema(
     *              type="string",
     *              enum={"read", "unread"}
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="search",
     *          in="query",
     *          description="Search by sender, subject, content, or created_at",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Latest 5 letters",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="type",
     *                          type="string",
     *                          example="letters"
     *                      ),
     *                      @OA\Property(
     *                          property="id",
     *                          type="string",
     *                          example="1"
     *                      ),
     *                      @OA\Property(
     *                          property="attributes",
     *                          type="object",
     *                              @OA\Property(
     *                                  property="sender",
     *                                  type="string",
     *                                  example="John Doe"
     *                              ),
     *                              @OA\Property(
     *                                  property="subject",
     *                                  type="string",
     *                                  example="Hello"
     *                              ),
     *                              @OA\Property(
     *                                  property="content",
     *                                  type="string",
     *                                  example="Hello, how are you?"
     *                              ),
     *                              @OA\Property(
     *                                  property="read",
     *                                  type="boolean",
     *                                  example="false"
     *                              ),
     *                              @OA\Property(
     *                                  property="image",
     *                                  type="string",
     *                                  example="https://example.com/image.jpg"
     *                              ),
     *                              @OA\Property(
     *                                  property="created_at",
     *                                  type="string",
     *                                  example="2021-10-10T10:00:00.000000Z"
     *                              ),
     *                      )
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="links",
     *                  type="object",
     *                  @OA\Property(
     *                      property="self",
     *                      type="string",
     *                      example="link-value"
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="meta",
     *                  type="object",
     *                  @OA\Property(
     *                      property="total",
     *                      type="integer",
     *                      example="1",
     *                  )
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="Letters not found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="errors",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="status",
     *                          type="integer",
     *                          example="404"
     *                      ),
     *                      @OA\Property(
     *                          property="title",
     *                          type="string",
     *                          example="Not Found"
     *                      ),            
     *                      @OA\Property(
     *                          property="detail",
     *                          type="string",
     *                          example="Letters not found."
     *                      )
     *                 )
     *             )
     *        )
     *    )
     * )          
     */
    public function index(Request $request): LettersCollection
    {
        $query = Letter::query();

        if ($request->has('status') && in_array($request->input('status'), ['read', 'unread'])) {
            $query->where('read', $request->input('status') === 'read');
        }

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where('sender', 'like', "%$search%")
                ->orWhere('subject', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%")
                ->orWhere('created_at', 'like', "%$search%");
        }

        $data = $query->orderBy('created_at', 'desc')
            ->paginate(20);

        if ($data->isEmpty()) {
            throw new LettersNotFoundException();
        }

        return new LettersCollection($data);
    }

    /**
     * @param Request $request
     * @param string $id
     * 
     * @OA\Put(
     *     path="/letters/{id}",
     *     summary="Update the read status of a letter",
     *     description="Toggles the 'read' field (true/false) of a letter by its ID.",
     *     operationId="updateLetterReadStatus",
     *     tags={"Letters"},
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
     *         description="The ID of the letter",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Letter status updated successfully."),
     *             @OA\Property(property="data", type="object",
     *                @OA\Property(
     *                    property="id", 
     *                   type="integer", 
     *                    example=1
     *                ),
     *                @OA\Property(
     *                    property="sender",
     *                    type="string",
     *                    example="John Doe"
     *                ),
     *                @OA\Property(
     *                    property="subject",
     *                     type="string",
     *                    example="Hello"
     *                ),
     *                @OA\Property(
     *                    property="content",
     *                    type="string",
     *                    example="Hello, how are you?"
     *                ),
     *                @OA\Property(
     *                    property="read",
     *                    type="boolean",
     *                    example="false"
     *                ),
     *                @OA\Property(
     *                    property="image_url",
     *                    type="string",
     *                    example="https://example.com/image.jpg"
     *                ),
     *                @OA\Property(
     *                    property="created_at",
     *                    type="string",
     *                    example="2021-10-10T10:00:00.000000Z"
     *                ),
     *                @OA\Property(
     *                    property="updated_at",
     *                    type="string",
     *                    example="2021-10-10T10:00:00.000000Z"
     *                ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Letter not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Letter not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=406,
     *         description="Invalid ID",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Invalid Letter ID.")
     *         )
     *     )
     * )
    */
    public function update(Request $request, string $id)
    {
        if( !is_numeric($id) ) {
            throw new InvalidIdException();
        }

        $letter = Letter::find($id);

        if (is_null($letter)) {
            throw new LettersNotFoundException();
        }
    
        $letter->read = !$letter->read;
    
        $letter->save();
    
        return response()->json([
            'message' => 'Letter status updated successfully.',
            'data' => $letter
        ], 200);
    }
}
