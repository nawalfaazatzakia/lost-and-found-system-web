<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatSendRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'message' => 'required|string',
            'sender' => 'required|integer|exists:users,id',
            'receiver' => 'nullable|integer|exists:users,id',
        ];
    }
}
