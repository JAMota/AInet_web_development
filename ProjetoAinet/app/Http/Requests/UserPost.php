<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'password' => 'sometimes|min:8,confirmed',
            'tipo' => 'required|in:F,A',
            'foto_url'=>'nullable|mimes:png,jpg|max:8192',
        ];
    }

    public function menssages(){
        return[
            'name.required' => 'Campo "name" tem que ser preenchido',
            'name.integer' => 'Campo "name  " tem que ser uma string com maximo de 255 characteres',
            'email.unique' => 'Campo "email" tem que ter unique(não pode ser partilhado entre contas)',
            'email.required' => 'Campo "email" tem que ser preenchido',
        ];
    }
}
