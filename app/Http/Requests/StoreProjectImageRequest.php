<?php

// app/Http/Requests/StoreProjectImageRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'project_id'     => 'required|exists:projects,id',
            'image_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt_text_en'    => 'required|string|max:255',
            'alt_text_ar'    => 'required|string|max:255',
            'is_main'        => 'required|boolean',
        ];
    }
}
