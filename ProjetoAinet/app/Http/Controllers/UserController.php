<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserPost;
use App\Http\Requests\BloquearPost;
use App\Http\Requests\PasswordPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit_password(){
        return view('auth.password_change');
    }
    public function update_password(PasswordPost $request){ #criar este post
        $user=auth()->user();
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.dashboard')
        ->with('alert-msg', 'Password alterada com sucesso')
        ->with('alert-type','success');
    }

    public function bloquear(User $user){ #criar este post

        if($user->bloqueado==0){
            $user->bloqueado=1;
        }else{
            $user->bloqueado=0;
        }

        $user->save();
        return redirect()->back()
        ->with('alert-msg', 'Estado do utilizador alterado')
        ->with('alert-type','success');
    }



    public function admin(Request $request)
    {
        $tipo = $request->tipo ?? '';

        // Use Debugbar to compare both solutions
        // Comment one of the following 2 lines

         $qry = User::query();

        if ($tipo) {
            $qry->where('tipo', $tipo);
        }
        $users = $qry->paginate(10);

        return view('users.admin', compact('users', 'tipo'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function create()
    {

        $user = new User;
        $user->user = new User;
        return view('users.create', compact('user'));
    }

    public function store(UserPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->tipo = $validated_data['tipo'];
        $newUser->password = Hash::make($validated_data['password']);
        if ($request->hasFile('foto_url')) {
            $path = $request->foto_url->store('public/fotos');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();
        $newUser -> sendEmailVerificationNotification();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->tipo = $validated_data['tipo'];
        if ($request->hasFile('foto_url')) {
            Storage::delete('public/fotos/' . $user->url_foto);
            $path = $request->foto->store('public/fotos');
            $user->foto_url = basename($path);
        }
        $user->user->save();

        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $user)
    {
        $oldName = $user->name;
        $user->delete();
        return redirect()->route('admin.users')
            ->with('alert-msg', 'User "' . $oldName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy_foto(User $user)
    {
        Storage::delete('public/fotos/' . $user->foto_url);
        $user->user->foto_url = null;
        $user->user->save();
        return redirect()->route('admin.users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do user "' . $user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}

//depois de cirar novo user -metodo store
//$user -> sendEmailVerificationNotification();

//criar destroy foto semelhante ao destroy photo do user

//gestao do carrinho com checkout e middleware isCliente
//gestao de estatisticas bilhete recibos

