<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectVideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project->id,
            'title_en' => $this->project->title_en,
            'title_ar' => $this->project->title_ar,
            'video_url' => $this->video_url,
            'caption_en' => $this->caption_en,
            'caption_ar' => $this->caption_ar,
            'thumbnail_path' => $this->thumbnail_path,
            'thumbnail_alt_en' => $this->thumbnail_alt_en,
            'thumbnail_alt_ar' => $this->thumbnail_alt_ar,
        ];
    }
}
