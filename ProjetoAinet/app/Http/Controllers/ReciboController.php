<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\Bilhete;
use App\Models\Configuracao;
use Illuminate\Http\Request;
use App\Http\Requests\ReciboPost;
use Illuminate\Support\Facades\Storage;

class ReciboController extends Controller
{
    public function admin()
    {
        $recibos = Recibo::all();
        return view('recibos.admin', compact('recibos'));
    }

    public function retrievePDF(Recibo $recibo)
    {

        return Storage::file('pdf_recibos/' . $recibo->recibo_url);
    }

    public function store(ReciboPost $request)
    {
        //$newFilme = Filme::create($request->all());
        $recibo = new Recibo();
        $recibo->fill($request->validated());
        $recibo->data = date('Y-m-d');
        $recibo->cliente_id = auth()->user()->id;
        $carrinho = $request->session()->get('carrinho', []);
        $conf = Configuracao::first();
        $recibo->preco_total_sem_iva = count($carrinho) * $conf->preco_bilhete_sem_iva;
        $recibo->iva = $recibo->preco_total_sem_iva * $conf->percentagem_iva / 100;
        $recibo->preco_total_com_iva = $recibo->preco_total_sem_iva + $recibo->iva;
        $recibo->save();
        foreach ($carrinho as $item) {
            $bilhete = new Bilhete();
            $bilhete->recibo_id =$recibo->id;
            $bilhete->cliente_id = auth()->user()->id;
            $bilhete->sessao_id=$item['sessao_id'];
            $bilhete->lugar_id=$item['lugar_id'];
            $bilhete->estado='não usado';
            $bilhete->save();
        }
        //criar pdf a partir de uma vista que recibo
        //enviar email
        //$recibo->recibo_url=
        //$recibo->save();
        //temos de guardar o recibo outra vez com a nova imformação do bilhete
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
