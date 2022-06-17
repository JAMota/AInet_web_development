<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Sessao;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index(Request $request)
    {
        return view('carrinho.index')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? []);
    }

    public function store_bilhete(Request $request, Sessao $sessao,Lugar $lugar)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $id=$sessao->id.'_'.$lugar->id;
        $carrinho[$id] = [
            'id' => $id,
            'titulo' => $sessao->filme->titulo,
            'cartaz_url' => $sessao->filme->cartaz_url,
            'data' => $sessao->data,
            'horario_inicio' => $sessao->horario_inicio,
            'lugar' => $lugar->fila.$lugar->posicao,
            'sala' => $sessao->sala->nome,
            'lugar_id' => $sessao->id,
            'sessao_id' => $sessao->id,
        ];
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionado um bilhete ao carrinho!')
            ->with('alert-type', 'success');
    }


    public function destroy_bilhete(Request $request, $id)
    {
        $carrinho = $request->session()->get('carrinho', []);
        if (array_key_exists($id, $carrinho)) {
            unset($carrinho[$id]);
            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foi removido o bilhete do carrinho')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'O bilhete não existe no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function confirmar(Request $request)
    {
        $cliente=auth()->user()->cliente;
        //chamar vista com form: nome_cliente, nif, tipo_pagamento, ref_pagamento
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }
}
