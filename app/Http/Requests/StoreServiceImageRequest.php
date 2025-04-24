<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceImageRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'service_id'     => 'required|exists:services,id',
            'image_path'     => 'nullable|image|max:2048',
            'alt_text_en'    => 'nullable|string|max:255',
            'alt_text_ar'    => 'nullable|string|max:255',
            'is_main'        => 'nullable|boolean',
        ];
    }
}
