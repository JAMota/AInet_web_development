<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    protected $table="Sessoes"; //se nome da tabela não corresponder ao plural do modelo

  protected $fillable = [
    'filme_id',
    'sala_id',
    'data',
    'horario_inicio',
];

    public function filme(){
        return $this->belongsTo(Filme::class,'filme_id','id');
    }
    public function bilhetes(){
        return $this->hasMany(Bilhete::class,'sessao_id','id');
    }
    public function sala(){
        return $this->hasMany(Sala::class,'sala_id','id')->withTrashed();
    }

}
