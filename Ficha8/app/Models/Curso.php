<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $primaryKey="abreviatura";
    protected $keyType="string";
    public $timestamps=false;
    protected $fillable=['abreviatura', 'nome', 'tipo','semestres','ECTS','vagas','contato','objetivos'];

    public function alunos(){
        return $this->hasMany(Aluno::class,'curso','abreviatura');
    }
    public function candidaturas(){
        return $this->hasMany(Candidatura::class,'curso','abreviatura');
    }
    public function disciplinas(){
        return $this->hasMany(Disciplina::class,'curso','abreviatura');
    }
}
