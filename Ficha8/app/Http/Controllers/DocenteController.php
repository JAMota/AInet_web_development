<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docente;
use App\Models\Disciplina;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Requests\DocentePost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $listaDisciplinas = Disciplina::all();
        $id = $request->query('disc', $listaDisciplinas[0]->id);
        $disciplina = Disciplina::findOrFail($id);
        $docentes = $disciplina->docentes;
        return view(
            'docentes.index',
            compact('docentes', 'listaDisciplinas', 'disciplina')
        );
    }
    public function admin(Request $request)
    {
        $departamento = $request->departamento ?? '';

        // Use Debugbar to compare both solutions
        // Comment one of the following 2 lines
        $qry = Docente::with('departamentoRef', 'user');
        //$qry =  Docente::query();

        if ($departamento) {
            $qry->where('departamento', $departamento);
        }
        $docentes = $qry->paginate(10);
        $departamentos = Departamento::pluck('nome', 'abreviatura');
        return view('docentes.admin', compact('docentes', 'departamentos', 'departamento'));
    }

    public function edit(Docente $docente)
    {
        $departamentos = Departamento::pluck('nome', 'abreviatura');
        return view('docentes.edit', compact('docente', 'departamentos'));
    }
    public function create()
    {
        $departamentos = Departamento::pluck('nome', 'abreviatura');
        $docente = new Docente;
        $docente->user = new User;
        return view('docentes.create', compact('docente', 'departamentos'));
    }

    public function store(DocentePost $request)
    {
        $validated_data = $request->validated();
        $newUser = new User;
        $newUser->email = $validated_data['email'];
        $newUser->name = $validated_data['name'];
        $newUser->admin = $validated_data['admin'];
        $newUser->tipo = 'D';
        $newUser->genero = $validated_data['genero'];
        $newUser->password = Hash::make('123');
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public/fotos');
            $newUser->url_foto = basename($path);
        }
        $newUser->save();
        $docente = new Docente;
        $docente->user_id = $newUser->id;
        $docente->departamento = $validated_data['departamento'];
        $docente->gabinete = $validated_data['gabinete'];
        $docente->extensao = $validated_data['extensao'];
        $docente->cacifo = $validated_data['cacifo'];
        $docente->save();
        return redirect()->route('admin.docentes')
            ->with('alert-msg', 'Docente "' . $validated_data['name'] . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(DocentePost $request, Docente $docente)
    {
        $validated_data = $request->validated();
        $docente->user->email = $validated_data['email'];
        $docente->user->name = $validated_data['name'];
        $docente->user->admin = $validated_data['admin'];
        $docente->user->genero = $validated_data['genero'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $docente->user->url_foto);
            $path = $request->foto->store('public/fotos');
            $docente->user->url_foto = basename($path);
        }
        $docente->user->save();
        $docente->departamento = $validated_data['departamento'];
        $docente->gabinete = $validated_data['gabinete'];
        $docente->extensao = $validated_data['extensao'];
        $docente->cacifo = $validated_data['cacifo'];
        $docente->save();
        return redirect()->route('admin.docentes')
            ->with('alert-msg', 'Docente "' . $docente->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Docente $docente)
    {
        if (count($docente->disciplinas)) {
            return redirect()->route('admin.alunos')
                ->with('alert-msg', 'Não foi possível apagar o Docente "' . $docente->user->name . '", porque este docente está associado a disciplinas!')
                ->with('alert-type', 'danger');
        }
        $oldName=$docente->user->name;
        $user = $docente->user();
        $docente->delete();
        Storage::delete('public/fotos/' . $user->url_foto);
        $user->delete();
        return redirect()->route('admin.docentes')
            ->with('alert-msg', 'Docente "' . $oldName . '" foi apagado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function destroy_foto(Docente $docente)
    {
        Storage::delete('public/fotos/' . $docente->user->url_foto);
        $docente->user->url_foto = null;
        $docente->user->save();
        return redirect()->route('admin.docentes.edit', ['docente' => $docente])
            ->with('alert-msg', 'Foto do docente "' . $docente->user->name . '" foi removida!')
            ->with('alert-type', 'success');
    }
}
