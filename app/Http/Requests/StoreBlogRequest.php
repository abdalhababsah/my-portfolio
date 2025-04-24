<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'slug' => 'required|string|max:255|unique:blogs,slug,' . $this->id,
            'slug' => 'required|string|max:255,' . $this->id,
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'summary_en' => 'nullable|string',
            'summary_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'reading_time' => 'nullable|integer|min:0',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_description_en' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string|max:255',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
        ];
    }
}
