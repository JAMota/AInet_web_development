<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Http\Requests\DisciplinaPost;

class DisciplinaController extends Controller
{
    public function admin_index(Request $request)
    {
        $curso = $request->curso ?? '';

        $qry = Disciplina::query();
        if ($curso) {
            $qry->where('curso', $curso);
        }
        $disciplinas = $qry->paginate(10);
        $cursos = Curso::pluck('nome', 'abreviatura');

        return view('disciplinas.admin', compact('disciplinas','cursos','curso'));
    }
    public function index(Request $request)
    {
        $cursos = Curso::pluck('nome', 'abreviatura');
        $curso = $request->query('curso', 'EI');
        $ano = $request->ano ?? 1;
        $discSem1 = Disciplina::where('curso', $curso)
            ->where('ano', $ano)
            ->where('semestre', 1)
            ->get();
        $discSem2 = Disciplina::where('curso', $curso)
            ->where('ano', $ano)
            ->where('semestre', 2)
            ->get();
        return view(
            'disciplinas.index',
            compact('discSem1', 'discSem2', 'ano', 'curso', 'cursos')
        );
    }
    public function edit(Disciplina $disciplina)
    {
        $cursos = Curso::all();
        return view('disciplinas.edit', compact('disciplina', 'cursos'));
    }
    public function create()
    {
        $cursos = Curso::all();
        $disciplina = new Disciplina();
        return view('disciplinas.create', compact('disciplina','cursos'));
    }
    public function store(DisciplinaPost $request)
    {
        //$newDisciplina = Disciplina::create($request->all());
        $disciplina = new Disciplina();
        $disciplina->fill($request->validated());
        $disciplina->save();
        return redirect()->route('admin.disciplinas')
            ->with('alert-msg', 'Disciplina "' . $disciplina->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(DisciplinaPost $request, Disciplina $disciplina)
    {
        $disciplina->fill($request->validated());
        $disciplina->save();
        return redirect()->route('admin.disciplinas')
            ->with('alert-msg', 'Disciplina "' . $disciplina->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Disciplina $disciplina)
    {
        if(count($disciplina->alunos)){
            return redirect()->route('admin.disciplinas')
                    ->with('alert-msg', 'Não foi possível apagar
                    a Disciplina "' . $disciplina->nome . '", porque esta disciplina está associada a alunos!')
                    ->with('alert-type', 'danger');
        }
        if(count($disciplina->docentes)){
            return redirect()->route('admin.disciplinas')
                    ->with('alert-msg', 'Não foi possível apagar
                    a Disciplina "' . $disciplina->nome . '", porque esta disciplina está associada a docentes!')
                    ->with('alert-type', 'danger');
        }

        $disciplina->delete();
        return redirect()->route('admin.disciplinas')
                ->with('alert-msg', 'Disciplina "' . $disciplina->nome . '" foi apagada com sucesso!')
                ->with('alert-type', 'success');

    }
}
