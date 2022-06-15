<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'curso', 'ano', 'semestre', 'abreviatura', 'nome', 'ECTS', 'horas', 'opcional'
    ];
    public function docentes()
    {
        return $this->belongsToMany(
            Docente::class,
            'docentes_disciplinas',
            'disciplina_id',
            'docente_id'
        );
    }
    public function alunos(){
        return $this->belongsToMany(
            Aluno::class,
            'alunos_disciplinas',
            'disciplina_id','aluno_id');
    }
    public function cursoRef(){
        return $this->belongsTo(Curso::class,'curso','abreviatura');
    }
}
