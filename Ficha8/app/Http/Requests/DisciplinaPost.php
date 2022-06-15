<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinaPost extends FormRequest
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
            'curso' =>       'required|exists:cursos,abreviatura',
            'ano' =>         'required|integer|between:1,3',
            'semestre' =>    'required|in:0,1,2',
            'abreviatura' => 'required|string|max:20',
            'nome' =>        'required',
            'ECTS' =>        'required|integer|between:1,100',
            'horas' =>       'required|integer|between:1,1000',
            'opcional' =>    'required|boolean',
        ];
    }
    public function messages(){
        return [
            'ECTS.required' => 'Campo "ECTS" tem que ser preenchido',
            'ECTS.integer' => 'Campo "ECTS" tem que ser um número inteiro',
            'ECTS.between' => 'Campo "ECTS" tem que ter um valor entre 1 e 1000 (inclusive)',
        ];
    }
}
