<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genero extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing=false;
    public $timestamps=false;
    protected $primaryKey="code"; //se chave primária não for id
    protected $keyType="string"; //se chave primária for string

    protected $fillable = [
        'code',
        'nome', //acrescentei porque a prof disse
    ];

    public function filmes(){
        return $this->hasMany(Filme::class,'genero_code','code');
    }

}
