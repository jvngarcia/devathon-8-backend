<?php
/**
 * AddressCollection
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
 * Address Collection
 *
 * @category Collection
 * @package  Collection\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class AddressCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request Request instance
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => $this->collection->transform(
                function ($address) {
                    return new AddressResource($address);
                }
            ),
            "meta" => [
                "total" => $this->collection->count()
            ]
        ];
    }
}
