<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'price' => $this->price,
            'currency' => $this->currency,
            'unit_en' => $this->unit_en,
            'unit_ar' => $this->unit_ar,
            'cover_image' => $this->cover_image,
            'meta_title_en' => $this->meta_title_en,
            'meta_title_ar' => $this->meta_title_ar,
            'meta_description_en' => $this->meta_description_en,
            'meta_description_ar' => $this->meta_description_ar,
            'meta_keywords_en' => $this->meta_keywords_en,
            'meta_keywords_ar' => $this->meta_keywords_ar,
        ];
    }
}
