<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'level' => 'required|integer|min:1|max:100',
            'category_id' => 'required|exists:categories,id',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png,svg,webp|max:2048', // adjust max size as needed
        ];
    }
}
