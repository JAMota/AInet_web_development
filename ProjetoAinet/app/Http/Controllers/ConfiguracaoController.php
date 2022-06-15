<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfiguracaoPost;
use App\Models\Configuracao;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function update(ConfiguracaoPost $request, Configuracao $configuracao)
    {
        $validated_data = $request->validated();
        $configuracao->fill($validated_data);
        $configuracao->save();
        return redirect()->route('admin.configuracao')
            ->with('alert-msg', 'Configuracao "' . $configuracao->nome . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
    public function edit(ConfiguracaoPost $configuracao)
    {
        return view('configuracao.edit', compact('configuracao'));
    }
}
