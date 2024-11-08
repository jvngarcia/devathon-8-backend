<?php
/**
 * AddressResource
 *
 * PHP version 8
 *
 * @category Resource
 * @package  Resource\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Address Resource
 *
 * @category Resource
 * @package  Resource\Address
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request Request instance
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'addresses',
            'id' => $this->id,
            'attributes' => [
                'address' => $this->address,
            ],
        ];
    }
}
