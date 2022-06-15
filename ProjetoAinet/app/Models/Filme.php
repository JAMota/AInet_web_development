<?php

namespace App\Models;

use Facade\FlareClient\Middleware\AnonymizeIp;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;


    protected $fillable = [
        'tipo',
        'titulo',
        'ano',
        'sumario',
        'genero_code',
        'trailer_url',
        'cartaz_url', //nao é necessário - nunca é preciso porque é a foto
    ];

    public function sessoes(){
        return $this->hasMany(Sessao::class,'filme_id','id');
    }
    public function genero(){
        return $this->belongsTo(Genero::class,'genero_code','code')->withTrashed();
    }

}
