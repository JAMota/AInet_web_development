<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lugar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="lugares"; //se nome da tabela não corresponder ao plural do modelo
    //public timestamps= False; a prof disse que é preciso na segunda feira

    protected $fillable = [
        'sala_id',
        'fila',
        'posicao'
    ];



    public function sala(){
        return $this->belongsTo(Sala::class,'sala_id','id')->withTrashed();
    }

    public function bilhetes(){
        return $this->hasMany(Bilhete::class,'sala_id','id');
    }
}
