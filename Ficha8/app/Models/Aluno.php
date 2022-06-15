<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['user_id','numero','curso'];

    public function cursoRef(){
        return $this->belongsTo(Curso::class,'curso','abreviatura');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class,'alunos_disciplinas','aluno_id','disciplina_id');
    }
}
