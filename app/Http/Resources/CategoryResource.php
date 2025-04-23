<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'meta_title_en' => $this->meta_title_en,
            'meta_title_ar' => $this->meta_title_ar,
            'meta_description_en' => $this->meta_description_en,
            'meta_description_ar' => $this->meta_description_ar,
            'meta_keywords_en' => $this->meta_keywords_en,
            'meta_keywords_ar' => $this->meta_keywords_ar,
        ];
    }
}
