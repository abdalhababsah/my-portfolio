<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'file_path' => $this->file_path,
            'issued_by' => $this->issued_by,
            'date_issued' => optional($this->date_issued)->format('Y-m-d'),
            'expiry_date' => optional($this->expiry_date)->format('Y-m-d'),
        ];
    }
}
