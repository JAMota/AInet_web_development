<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nif' => 'string|max:8',
            'email' => 'required|unique|string|max:255',
            'tipo_pagamento',

        ];
    }
}
