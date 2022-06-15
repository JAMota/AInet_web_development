<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\CursoPost;

class CursoController extends Controller
{
    public function index(){
        $cursos = Curso::all();
        return view('cursos.index',compact('cursos'));
    }
    public function admin()
    {
        $cursos = Curso::all();
        return view('cursos.admin',compact('cursos'));
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }
    public function create()
    {
        $curso = new Curso;
        return view('cursos.create', compact('curso'));
    }

    public function store(CursoPost $request)
    {
        $validated_data = $request->validated();
        $curso= new Curso();
        $curso->fill($validated_data);
        $curso->save();
        return redirect()->route('admin.cursos')
            ->with('alert-msg', 'Curso "' . $curso->nome . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function update(CursoPost $request, Curso $curso)
    {
        $validated_data = $request->validated();
        $curso->fill($validated_data);
        $curso->save();
        return redirect()->route('admin.cursos')
            ->with('alert-msg', 'Curso "' . $curso->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy(Curso $curso)
    {
        if (count($curso->disciplinas)){
            return redirect()->route('admin.cursos')
            ->with('alert-msg', 'Não foi possível apagar o Curso "' . $curso->nome . '", porque este curso já está associado a disciplinas!')
            ->with('alert-type', 'danger');
        }
        if (count($curso->alunos)){
            return redirect()->route('admin.cursos')
            ->with('alert-msg', 'Não foi possível apagar o Curso "' . $curso->nome . '", porque este curso já está associado a alunos!')
            ->with('alert-type', 'danger');
        }
        if (count($curso->candidaturas)){
            return redirect()->route('admin.cursos')
            ->with('alert-msg', 'Não foi possível apagar o Curso "' . $curso->nome . '", porque este curso já está associado a candidaturas!')
            ->with('alert-type', 'danger');
        }
        $oldName=$curso->nome;
        $curso->delete();
        return redirect()->route('admin.cursos')
                ->with('alert-msg', 'Curso "' . $oldName . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
    }
}
