<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BilheteController extends Controller
{
    public function admin(Request $request)
    {
         $qry = Bilhete::with('user');

        return view('bilhete.admin', compact('bilhetes', ''));
    }

    public function show(Bilhete $bilhete)
    {
        $data=Carbon::now()->subMinutes(5)->format('Y-m-d');
        $horario=Carbon::now()->subMinutes(5)->format('H-i-s');

        $sessoes = $bilhete->sessoes()->where('data','>',$data)->orWhere([['data','=',$data],['horario_inicio','>=',$horario]])->get();
        return view('bilhetes.show', compact('bilhete', 'sessoes'));
    }

    public function validar_invalidar(Bilhete $bilhete)
    {

        //$ = $bilhete-> ->get();
        return view('bilhetes.', compact('bilhete', ''));
    }

    public function downloadBilhetePDF(Bilhete $bilhete)
    {

        //$ = $bilhete-> ->get();
        return view('bilhetes.', compact('bilhete', ''));
    }

    public function editValidar(Bilhete $bilhete)
    {

        //$ = $bilhete-> ->get();
        return view('bilhetes.', compact('bilhete', ''));
    }

    public function updateValidar(Bilhete $bilhete)
    {

        //$ = $bilhete-> ->get();
        return view('bilhetes.', compact('bilhete', ''));
    }

}


//PROFESSORA AJUDAR NA OPCAO BLOQUEAR DESBLOQUEAR
