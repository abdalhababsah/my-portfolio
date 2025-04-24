<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'category_name_en' => $this->category->name_en,
            'category_name_ar' => $this->category->name_ar,
            'short_description_en' => $this->short_description_en,
            'short_description_ar' => $this->short_description_ar,
            'full_description_en' => $this->full_description_en,
            'full_description_ar' => $this->full_description_ar,
            'role_en' => $this->role_en,
            'role_ar' => $this->role_ar,
            'duration_en' => $this->duration_en,
            'duration_ar' => $this->duration_ar,
            'client_name' => $this->client_name,
            'location' => $this->location,
            'year' => $this->year,
            'cover_image' => $this->cover_image,

            // 'category_id' => $this->category_id,

            'github_url' => $this->github_url,
            'demo_url' => $this->demo_url,
        ];
    }
}
