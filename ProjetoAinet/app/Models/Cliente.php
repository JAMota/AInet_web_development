<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    //o cliente não é auto incrementado pq o id tem de ser o mesmo que o id do user
    public $incrementing=false;

    protected $fillable = [
        'nif' => 'string|max:9',
        'tipo_pagamento' => 'string',
        'ref_pagamento',
    ];

    public function user(){

        return $this->belongsTo(User::class,'id','id');
    }

    public function bilhetes(){

        return $this->hasMany(Bilhete::class,'cliente_id','id');
    }
    public function recibos(){

        return $this->hasMany(Recibo::class,'cliente_id','id');
    }


}
