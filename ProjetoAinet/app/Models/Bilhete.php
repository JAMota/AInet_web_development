<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    use HasFactory;

    protected $fillable = [
        'lugar_id',
        'estado',
        'sessao_id',

    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id','id')->withTrashed();
    }
    public function recibo(){
        return $this->belongsTo(Recibo::class,'recibo_id','id');
    }
    public function sessao(){
        return $this->belongsTo(Sessao::class,'sessao_id','id');
    }
    public function lugar(){
        return $this->belongsTo(Lugar::class,'lugar_id','id')->withTrashed();
    }

}
