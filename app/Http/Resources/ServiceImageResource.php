<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'service_id'  => $this->service_id,
            'image_path'  => $this->image_path,
            'alt_text_en' => $this->alt_text_en,
            'alt_text_ar' => $this->alt_text_ar,
            'is_main'     => $this->is_main ? 'Yes' : 'No',
        ];
    }
}
