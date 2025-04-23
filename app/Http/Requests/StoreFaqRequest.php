<?php
// app/Http/Requests/StoreFaqRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'question_en' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer_en'   => 'required|string',
            'answer_ar'   => 'required|string',
            'display_order' => 'nullable|integer',
        ];
    }
}
