<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{

    /**
     * Remove data key
     */
    public static $wrapp = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'uuid' => $this->uuid,
            'subject' => $this->subject,
            'content' => $this->content
        ];
    }
}
