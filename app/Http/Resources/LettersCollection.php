<?php

/**
 * LettersCollection
 *
 * PHP version 8
 *
 * @category Collection
 * @package  Collection\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * LettersCollection
 *
 * @category Collection
 * @package  Collection\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class LettersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => $this->collection->transform(
                function ($letter) {
                    return new LettersResource($letter);
                }
            ),
            'links' => [
                'self' => 'link-value',
            ],
            'meta' => [
                'key' => 'value',
            ],
        ];
    }
}
