<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{


    public function rules()
    {
        return [
            'slug' => 'required|string|max:255|unique:services,slug,' . $this->route('service'),
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:10',
            'unit_en' => 'nullable|string|max:50',
            'unit_ar' => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|max:2048',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string|max:255',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
        ];
    }
}
