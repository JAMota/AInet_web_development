<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\ClientePost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function admin(Request $request)
    {
        $pesq_name = $request->pesq_name ?? '';

        // Use Debugbar to compare both solutions
        // Comment one of the following 2 lines

         $qry = Cliente::with('user');
        //$qry =  Cliente::query();

        if ($pesq_name) {
            $qry->whereHas('user', function ($query) use ($pesq_name){
                $query->where('name','like', "%$pesq_name%");
            });
        }
        $clientes = $qry->paginate(10);


        return view('cliente.admin', compact('clientes', 'pesq_name'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }
    public function create()
    {
        $cliente = new Cliente;
        $cliente->user = new User;
        return view('clientes.create', compact('cliente'));
    }

    public function store(ClientePost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->admin = false;
        $newUser->tipo = 'C';
        $newUser->genero = $validated_data['genero'];
        $newUser->password = Hash::make($validated_data['password']);
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos');
            $newUser->foto_url = basename($path);
        }
        $newUser->save();
        $cliente = new Cliente;
        $cliente->user_id = $newUser->id;
        $cliente->fill($validated_data);
        $cliente->save();
        //mandar mail
        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(ClientePost $request, Cliente $cliente)
    {
        $validated_data = $request->validated();
        $cliente->user->email = $validated_data['email'];
        $cliente->user->name = $validated_data['name'];
        $cliente->user->genero = $validated_data['genero'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $cliente->user->foto_url);
            $path = $request->foto->store('public/fotos');
            $cliente->user->foto_url = basename($path);
        }
        $cliente->user->save();
        $cliente->fill($validated_data);
        $cliente->save();
        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $cliente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cliente $cliente)
    {

        $oldName = $cliente->user->name;
        $user = $cliente->user;
        $cliente->delete();
        $user->delete();
        return redirect()->route('admin.clientes')
            ->with('alert-msg', 'Cliente "' . $oldName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy_foto(Cliente $cliente)
    {
        Storage::delete('public/fotos/' . $cliente->user->foto_url);
        $cliente->user->foto_url = null;
        $cliente->user->save();
        return redirect()->route('admin.clientes.edit', ['cliente' => $cliente])
            ->with('alert-msg', 'Foto do cliente "' . $cliente->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

}
