<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReciboPost;
use App\Models\Recibo;
use Illuminate\Http\Request;

class ReciboController extends Controller
{
    public function admin()
    {
        $recibos = Recibo::all();
        return view('recibos.admin',compact('recibos'));
    }

    public function retrievePDF()
    {

        return view('recibos.',compact('recibos'));
    }

    public function store(ReciboPost $request)
    {
        //$newFilme = Filme::create($request->all());
        $recibo = new Recibo();
        $recibo->fill($request->validated());
        $recibo->save();
        return redirect()->route('admin.recibos')
            ->with('alert-msg', 'Lugar "' . $recibo->id . '" foi criado com sucesso!')
            ->with('alert-type', 'success');
    }

    public function show(Recibo $recibo)
    {

        //$bilhetes = $recibo->bilhetes()->where('data','>',$data)->orWhere([['data','=',$data],['horario_inicio','>=',$horario]])->get();
        return view('recibos.show', compact('recibo', 'bilhetes'));
    }
}
