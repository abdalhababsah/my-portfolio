<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'project_id'   => $this->project_id,
            'image_path'   => $this->image_path,
            'alt_text_en'  => $this->alt_text_en,
            'alt_text_ar'  => $this->alt_text_ar,
            'is_main'      => $this->is_main,
        ];
    }
}
