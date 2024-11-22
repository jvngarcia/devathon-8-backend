<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LettersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'letters',
            'id' => $this->id,
            'attributes' => [
                'sender' => $this->sender,
                'subject' => $this->subject,
                'content' => $this->content,
                'read' => $this->read,
                'image' => $this->image_url,
                'created_at' => $this->created_at,
            ],
        ];
    }
}
