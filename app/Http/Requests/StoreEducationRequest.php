<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'institution_en' => 'required|string|max:255',
            'institution_ar' => 'required|string|max:255',
            'degree_en'      => 'required|string|max:255',
            'degree_ar'      => 'required|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ];
    }
}
