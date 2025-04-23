<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'issued_by' => 'nullable|string|max:100',
            'date_issued' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:date_issued',
        ];
    }
}
