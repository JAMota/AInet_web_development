<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlunoPost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>         'required',
            'genero' =>       'required|in:M,F',
            'curso' =>        'required|exists:cursos,abreviatura',
            'numero' =>       'required|digits:7',
            'email' =>       'required|email|unique:users,email,'.$this->user_id,
            'foto' =>         'nullable|image|max:8192',   // Máximum size = 8Mb
        ];
    }
}
