<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Candidatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidaturaController extends Controller
{
    public function create()
    {
        $cursos = Curso::pluck('nome', 'abreviatura');
        return view('candidaturas.create', compact('cursos'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'curso' => 'bail|required|exists:cursos,abreviatura',
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telefone1' => 'nullable|digits:9',
            'telefone2' => 'nullable|digits:9',
            'genero' => 'required|in:M,F',
            'media' => 'required|numeric|between:0,20',
            'm23' => 'required|in:0,1',
            'origem' => 'required|in:P,UE,O',
            'obs' => 'nullable',
            'estatutos' => 'nullable|array',
            'estatutos.*' => 'required|in:TE,NE,E',
        ], [
            'curso.required' => 'É obrigatório escolher um curso',
            'telefone1.digits' => 'O telefone 1 tem que ter 9 digitos'
        ]);

        $newCandidatura = Candidatura::create($validatedData);
        $candidaturas_estatutos = [
            [
                'candidatura_id' => $newCandidatura->id,
                'estatuto' => 'TE',
                'pretende' => '0'
            ],
            [
                'candidatura_id' => $newCandidatura->id,
                'estatuto' => 'NE',
                'pretende' => '0'
            ],
            [
                'candidatura_id' => $newCandidatura->id,
                'estatuto' => 'E',
                'pretende' => '0'
            ]
        ];

        if (array_key_exists('estatutos', $validatedData)) {
            $candidaturas_estatutos[0]['pretende'] =
                in_array("TE", $validatedData['estatutos']) ? '1' : '0';
            $candidaturas_estatutos[1]['pretende'] =
                in_array("NE", $validatedData['estatutos']) ? '1' : '0';
            $candidaturas_estatutos[2]['pretende'] =
                in_array("E", $validatedData['estatutos']) ? '1' : '0';
        }
        DB::table('candidaturas_estatutos')->insert($candidaturas_estatutos);
        return redirect()->route('home')
            ->with('alert-msg', 'Candidatura foi enviada com sucesso!')
            ->with('alert-type', 'success');
    }
}
