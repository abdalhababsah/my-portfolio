<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'full_description_en' => 'nullable|string',
            'full_description_ar' => 'nullable|string',
            'role_en' => 'nullable|string|max:255',
            'role_ar' => 'nullable|string|max:255',
            'duration_en' => 'nullable|string|max:100',
            'duration_ar' => 'nullable|string|max:100',
            'cover_image' => 'nullable|file|image|max:2048',
            'featured' => 'boolean',
            'category_id' => 'nullable|integer|exists:categories,id',
            'github_url' => 'nullable|url|max:255',
            'demo_url' => 'nullable|url|max:255',
        ];
    }
}
