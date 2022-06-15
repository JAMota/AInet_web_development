<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Sessao;
use Illuminate\Http\Request;
use App\Http\Requests\SessaoPost;

class SessaoController extends Controller
{
    public function admin_index(Request $request)
    {
        $genero = $request->genero ?? '';

        $qry = Sessao::query();
        if ($genero) {
            $qry->where('genero', $genero);
        }
        $sessoes = $qry->paginate(10);
        $generos = Genero::pluck('nome', 'code');

        return view('sessoes.admin', compact('sessoes','generos','genero'));
    }
    public function index(Request $request)
    {
        $generos = Genero::pluck('nome', 'code');
        $genero = $request->query('genero', 'EI'); //tem de se alterar que admin nao existe
        $ano = $request->ano ?? 1;
        $discSem1 = Sessao::where('genero', $genero)
            ->where('ano', $ano)
        //    ->where('semestre', 1)
            ->get();
        return view(
            'sessoes.index',
            compact('ano', 'genero', 'generos')
        );
    }
    public function edit(Sessao $sessao)
    {
        $generos = Genero::all();
        return view('sessoes.edit', compact('sessao', 'generos'));
    }
    public function create()
    {
        $generos = Genero::all();
        $sessao = new Sessao();
        return view('sessoes.create', compact('sessao','generos'));
    }
    public function store(SessaoPost $request)
    {
        //$newSessao = Sessao::create($request->all());
        $sessao = new Sessao();
        $sessao->fill($request->validated());
        $sessao->save();
        return redirect()->route('admin.sessoes')
            ->with('alert-msg', 'Sessao "' . $sessao->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(SessaoPost $request, Sessao $sessao)
    {
        $sessao->fill($request->validated());
        $sessao->save();
        return redirect()->route('admin.sessoes')
            ->with('alert-msg', 'Sessao "' . $sessao->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Sessao $sessao)
    {
        if(count($sessao->sessoes)){
            return redirect()->route('admin.sessoes')
                    ->with('alert-msg', 'Não foi possível apagar
                    o Sessao "' . $sessao->nome . '", porque este sessao está associado a sessoes!')
                    ->with('alert-type', 'danger');
        }
        $sessao->delete();
        return redirect()->route('admin.sessoes')
                ->with('alert-msg', 'Sessao "' . $sessao->nome . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');

    }
}
