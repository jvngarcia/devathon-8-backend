<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
