<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\AlunoPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{
    public function admin(Request $request)
    {
        $curso = $request->curso ?? '';

        // Use Debugbar to compare both solutions
        // Comment one of the following 2 lines

         $qry = Aluno::with('cursoRef', 'user');
        //$qry =  Aluno::query();

        if ($curso) {
            $qry->where('curso', $curso);
        }
        $alunos = $qry->paginate(10);

        /*
        OU
        if ($curso && ($cursoRef = Curso::find($curso))) {
            $alunos = $cursoRef->alunos()->paginate(10);
        } else {
            $alunos = Aluno::paginate(10);
        }*/
        $cursos = Curso::pluck('nome', 'abreviatura');
        return view('alunos.admin', compact('alunos', 'cursos', 'curso'));
    }

    public function edit(Aluno $aluno)
    {
        $cursos = Curso::pluck('nome', 'abreviatura');
        return view('alunos.edit', compact('aluno', 'cursos'));
    }
    public function create()
    {
        $cursos = Curso::pluck('nome', 'abreviatura');
        $aluno = new Aluno;
        $aluno->user = new User;
        return view('alunos.create', compact('aluno', 'cursos'));
    }

    public function store(AlunoPost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->admin = false;
        $newUser->tipo = 'A';
        $newUser->genero = $validated_data['genero'];
        $newUser->password = Hash::make('123');
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos');
            $newUser->url_foto = basename($path);
        }
        $newUser->save();
        $aluno = new Aluno;
        $aluno->user_id = $newUser->id;
        $aluno->curso = $validated_data['curso'];
        $aluno->numero = $validated_data['numero'];
        $aluno->save();
        return redirect()->route('admin.alunos')
            ->with('alert-msg', 'Aluno "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(AlunoPost $request, Aluno $aluno)
    {
        $validated_data = $request->validated();
        $aluno->user->email = $validated_data['email'];
        $aluno->user->name = $validated_data['name'];
        $aluno->user->genero = $validated_data['genero'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $aluno->user->url_foto);
            $path = $request->foto->store('public/fotos');
            $aluno->user->url_foto = basename($path);
        }
        $aluno->user->save();
        $aluno->curso = $validated_data['curso'];
        $aluno->numero = $validated_data['numero'];
        $aluno->save();
        return redirect()->route('admin.alunos')
            ->with('alert-msg', 'Aluno "' . $aluno->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Aluno $aluno)
    {
        if (count($aluno->disciplinas)) {
            return redirect()->route('admin.alunos')
                ->with('alert-msg', 'Não foi possível apagar o Aluno "' . $aluno->user->name . '", porque este aluno está associado a disciplinas!')
                ->with('alert-type', 'danger');
        }
        $oldName = $aluno->user->name;
        $user = $aluno->user;
        $aluno->delete();
        Storage::delete('public/fotos/' . $user->url_foto);
        $user->delete();
        return redirect()->route('admin.alunos')
            ->with('alert-msg', 'Aluno "' . $oldName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy_foto(Aluno $aluno)
    {
        Storage::delete('public/fotos/' . $aluno->user->url_foto);
        $aluno->user->url_foto = null;
        $aluno->user->save();
        return redirect()->route('admin.alunos.edit', ['aluno' => $aluno])
            ->with('alert-msg', 'Foto do aluno "' . $aluno->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

}
