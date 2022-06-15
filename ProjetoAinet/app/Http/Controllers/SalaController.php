<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use App\Http\Requests\SalaPost;

class SalaController extends Controller
{
    public function admin()
    {
        $salas = Sala::all();
        return view('salas.admin',compact('salas'));
    }

    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }
    public function create()
    {
        $sala = new Sala;
        return view('salas.create', compact('sala'));
    }

    public function store(SalaPost $request)
    {
        $validated_data = $request->validated();
        $sala= new Sala();
        $sala->fill($validated_data);
        $sala->save();
        return redirect()->route('admin.salas')
            ->with('alert-msg', 'Sala "' . $sala->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function update(SalaPost $request, Sala $sala)
    {
        $validated_data = $request->validated();
        $sala->fill($validated_data);
        $sala->save();
        return redirect()->route('admin.salas')
            ->with('alert-msg', 'Sala "' . $sala->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy(Sala $sala)
    {
        if (count($sala->disciplinas)){
            return redirect()->route('admin.salas')
            ->with('alert-msg', 'Não foi possível apagar o Sala "' . $sala->nome . '", porque este sala já está associado a disciplinas!')
            ->with('alert-type', 'danger');
        }
        if (count($sala->alunos)){
            return redirect()->route('admin.salas')
            ->with('alert-msg', 'Não foi possível apagar o Sala "' . $sala->nome . '", porque este sala já está associado a alunos!')
            ->with('alert-type', 'danger');
        }
        if (count($sala->candidaturas)){
            return redirect()->route('admin.salas')
            ->with('alert-msg', 'Não foi possível apagar o Sala "' . $sala->nome . '", porque este sala já está associado a candidaturas!')
            ->with('alert-type', 'danger');
        }
        $oldName=$sala->nome;
        $sala->delete();
        return redirect()->route('admin.salas')
                ->with('alert-msg', 'Sala "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }
}

