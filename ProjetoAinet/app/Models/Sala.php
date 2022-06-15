<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sala extends Model
{
    use HasFactory;
    use SoftDeletes; //se tabela tiver coluna deleted_at

    public $timestamps=false; //se não tiver colunas $created_at e $updated_at;

    protected $fillable = [
        'nome',
    ];

    public function sessoes(){
        return $this->hasMany(Sessao::class,'sala_id','id');
    }
    public function lugares(){
        return $this->hasMany(Lugar::class,'sala_id','id');
    }
}
