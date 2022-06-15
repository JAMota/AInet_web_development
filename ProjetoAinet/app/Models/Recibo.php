<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'data', //se a data for a atual nao é para pôr no fillable
        'nif',
        'tipo_pagamento',
        'ref_pagamento',
        'nome_cliente',

    ];

    public function cliente(){
        return $this->belongsTo(cliente::class,'client_id','id')->withTrashed(); //o primeiro id é a chave primaria e a outra é a chave estrageira
    }
    public function bilhetes(){
        return $this->hasMany(Bilhete::class,'recibo_id','id');
    }

}
