<?php
// app/Http/Resources/TestimonialResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'image' => $this->image,
            'rating' => $this->rating,
            'message_en' => $this->message_en,
            'message_ar' => $this->message_ar,
            'date_given' => $this->date_given->format('m/d/Y'),
        ];
    }
}
