<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectVideoRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'video_file' => 'required|file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:1024000',
            'caption_en' => 'nullable|string|max:255',
            'caption_ar' => 'nullable|string|max:255',
            'thumbnail_path' => 'nullable|image|max:2048',
            'thumbnail_alt_en' => 'nullable|string|max:255',
            'thumbnail_alt_ar' => 'nullable|string|max:255',
        ];
    }
}
