<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressCollection extends ResourceCollection
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
