<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['user_id','departamento','gabinete','extensao','cacifo'];
    public function departamentoRef()
    {
        return $this->belongsTo(Departamento::class, 'departamento', 'abreviatura');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function disciplinas()
    {
        return $this->belongsToMany(
            Disciplina::class,
            'docentes_disciplinas',
            'docente_id',
            'disciplina_id'
        );
    }
}
