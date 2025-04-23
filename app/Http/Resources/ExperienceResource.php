<?php
// app/Http/Resources/ExperienceResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_en' => $this->company_en,
            'company_ar' => $this->company_ar,
            'position_en' => $this->position_en,
            'position_ar' => $this->position_ar,
            'start_date' => $this->start_date->format('m/d/Y'),
            'end_date' => $this->end_date ? $this->end_date->format('m/d/Y') : null,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
        ];
    }
}
