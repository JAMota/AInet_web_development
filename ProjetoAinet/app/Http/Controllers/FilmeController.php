<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Filme;
use App\Models\Genero;
use App\Models\Sessao;
use Illuminate\Http\Request;
use App\Http\Requests\FilmePost;

class FilmeController extends Controller
{
    public function admin_index(Request $request)
    {
        $genero = $request->genero ?? '';

        $qry = Filme::query();
        if ($genero) {
            $qry->where('genero', $genero);
        }
        $filmes = $qry->paginate(10);
        $generos = Genero::pluck('nome', 'code');

        return view('filmes.admin', compact('filmes','generos','genero'));
    }
    public function index(Request $request)
    {
        $data=Carbon::now()->subMinutes(5)->format('Y-m-d');
        $horario=Carbon::now()->subMinutes(5)->format('H-i-s');

        $generos = Genero::pluck('nome', 'code');

        $genero = $request->query('genero', ''); //tem de se alterar que admin nao existe
        $ano = $request->ano ?? '';
        $titulo = $request->titulo ?? '';

        $filmes=Filme::query();

        if($genero){
            $filmes->where('genero', $genero);
        }
        if($ano){
            $filmes->where('ano', $ano);
        }
        if($titulo){
            $filmes->where('titulo','like' ,"%$titulo%");
        }

        $filmes_id=Sessao::where('data','>',$data)->orWhere([['data','=',$data],['horario_inicio','>=',$horario]])->pluck('filme_id');
        $filmes = $filmes ->whereIn('id',$filmes_id)->get();
        return view(
            'filmes.index',
            compact('ano', 'genero', 'generos','titulo','filmes')
        );
    }
    public function edit(Filme $filme)
    {
        $generos = Genero::all();
        return view('filmes.edit', compact('filme', 'generos'));
    }
    public function create()
    {
        $generos = Genero::all();
        $filme = new Filme();
        return view('filmes.create', compact('filme','generos'));
    }
    public function store(FilmePost $request)
    {
        //$newFilme = Filme::create($request->all());
        $filme = new Filme();
        $filme->fill($request->validated());
        $filme->save();
        return redirect()->route('admin.filmes')
            ->with('alert-msg', 'Filme "' . $filme->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(FilmePost $request, Filme $filme)
    {
        $filme->fill($request->validated());
        $filme->save();
        return redirect()->route('admin.filmes')
            ->with('alert-msg', 'Filme "' . $filme->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Filme $filme)
    {
        if(count($filme->sessoes)){
            return redirect()->route('admin.filmes')
                    ->with('alert-msg', 'Não foi possível apagar
                    o Filme "' . $filme->nome . '", porque este filme está associado a sessoes!')
                    ->with('alert-type', 'danger');
        }
        $filme->delete();
        return redirect()->route('admin.filmes')
                ->with('alert-msg', 'Filme "' . $filme->nome . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');

    }
}
