<?php

namespace App\Http\Controllers;

use App\Http\Requests\LugarPost;
use App\Models\Lugar;
use App\Models\Sala;
use Illuminate\Http\Request;

class LugarController extends Controller
{
    public function create()
    {
        $salas = Sala::all();
        $lugar = new Lugar();
        return view('lugares.create', compact('lugar','salas'));
    }

    public function store(LugarPost $request)
    {
        //$newFilme = Filme::create($request->all());
        $lugar = new Lugar();
        $lugar->fill($request->validated());
        $lugar->save();
        return redirect()->route('admin.lugares')
            ->with('alert-msg', 'Lugar "' . $lugar->id . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function admin()
    {
        $lugares = Lugar::all();
        return view('lugares.admin',compact('lugares'));
    }

    public function edit(Lugar $lugar)
    {
        return view('lugares.edit', compact('lugar'));
    }

    public function update(LugarPost $request, Lugar $lugar)
    {
        $validated_data = $request->validated();
        $lugar->fill($validated_data);
        $lugar->save();
        return redirect()->route('admin.lugares')
            ->with('alert-msg', 'Lugar "' . $lugar->id . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Lugar $lugar)
    {
        if(!$lugar->sala->trashed()){
            return redirect()->route('admin.lugares')
                    ->with('alert-msg', 'Não foi possível apagar
                    o Lugar "' . $lugar->id . '", porque este lugar está associado a salas!')
                    ->with('alert-type', 'danger');
        }
        $lugar->delete();
        return redirect()->route('admin.lugares')
                ->with('alert-msg', 'Lugar "' . $lugar->id . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');

    }
}
