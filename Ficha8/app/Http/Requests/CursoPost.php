<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoPost extends FormRequest
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
    public function rules(){
        return [
            'abreviatura' => 'required|string|max:20|unique:cursos,abreviatura,'.$this->curso_abreviatura.',abreviatura',
            'nome' =>        'required',
            'tipo' =>        'required|in:"Licenciatura","Mestrado","Curso Técnico Superior Profissional"',
            'semestres' =>   'required|integer|between:1,6',
            'ECTS' =>        'required|integer|min:1',
            'vagas' =>       'required|integer|between:0,500',
            'contato' =>     'required|email',
            'objetivos' =>   'required'
        ];
    }
}
