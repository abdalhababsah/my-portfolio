<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'summary_en' => $this->summary_en,
            'summary_ar' => $this->summary_ar,
            'content_en' => $this->content_en,
            'content_ar' => $this->content_ar,
            'cover_image' => $this->cover_image,
            'reading_time' => $this->reading_time,
            'meta_title_en' => $this->meta_title_en,
            'meta_title_ar' => $this->meta_title_ar,
            'meta_description_en' => $this->meta_description_en,
            'meta_description_ar' => $this->meta_description_ar,
            'meta_keywords_en' => $this->meta_keywords_en,
            'meta_keywords_ar' => $this->meta_keywords_ar,
        ];
    }
}
