<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'institution_en' => $this->institution_en,
            'institution_ar' => $this->institution_ar,
            'degree_en' => $this->degree_en,
            'degree_ar' => $this->degree_ar,
            'start_date' => optional($this->start_date)->format('Y-m-d'),
            'end_date' => optional($this->end_date)->format('Y-m-d'),
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
        ];
    }
}
