<?php

/**
 * LettersResource
 *
 * PHP version 8
 *
 * @category Resource
 * @package  Resource\Letter
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * LettersResource
 *
 * @category Resource
 * @package  Resource\Letter
 * @author   Angel García <angelgarciaweb@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
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
