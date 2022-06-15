<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'abreviatura';
    protected $keyType = 'string';

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'departamento', 'abreviatura');
    }
}
