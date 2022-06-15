<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessaoPost extends FormRequest
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
            'filme_id'=>        'required|foreign_key',
            'sala_id'=>         'required|foreign_key',
            'data'=>            'required|'
        ];
    }
}

/*rotas
ativacao de email
1.Ativar rota - em cima Auth::routes(['register' => false], 'verify'=>true)
2.Aplicar um middleware 'verified' em cima Route::middleware(['auth','verified'])
3.no modelo user implements MustVerifyEmail
4.Configurar email
    mailtrap.io ficheiro env e só deixar as 2 últimas linhas

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=415159d93e9d74
    MAIL_PASSWORD=71e4c2eb285db0
    MAIL_ENCRYPTION=tls5.se criaram rota para registar user, apos guardar novo user enviar email:
        $newUser->sendEmailVerificationNotification();
*/
