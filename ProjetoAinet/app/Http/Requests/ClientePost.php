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
        $rules="required_with:tipo_pagamento";
        if($this->tipo_pagamento=='VISA'){
            $rules.="|digits:16";
        }elseif($this->tipo_pagamento=='PAYPAL'){
            $rules.="|email";
        }elseif($this->tipo_pagamento=='MBWAY'){
            $rules.="|digits:9|regex:/(9[0-9]{8})/";
        }
        return [ //nao podemos adicionar mais regras de validação pq senao dá Validation rule unique requires at least 1 parameters.
            'nif' => 'string|max:8',
            'tipo_pagamento' => 'nullable|in:VISA,PAYPAL,MBWAY',
            'ref_pagamento' => $rules,
            'name' => 'required|string|max:255',
            'email' => 'email|unique:users,email,'.$this->user_id,
            'foto_url'=>'nullable|mimes:png,jpg|max:8192',
            'password' => 'sometimes|min:8|confirmed',

        ];
    }
}

/*
'name' => 'required|string|max:255',
'email' => 'required|unique|string|max:255',
'password' => 'sometimes',
'tipo' => 'required|max:1',
'bloqueado'  => 'required|max:1',
'foto_url',
*/
