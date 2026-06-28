<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaimStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'report_id' => 'required|integer|exists:reports,id',
            'proof' => 'nullable|string',
        ];
    }
}
