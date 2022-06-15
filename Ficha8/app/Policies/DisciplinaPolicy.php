<?php

namespace App\Policies;

use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisciplinaPolicy
{
    use HandlesAuthorization;


    // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Disciplina" entity
    public function before($user, $ability)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->tipo == 'D';
    }

    public function view(User $user, Disciplina $disciplina)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Disciplina $disciplina)
    {
        return false;
    }

    public function delete(User $user, Disciplina $disciplina)
    {
        return false;
    }

    public function restore(User $user, Disciplina $disciplina)
    {
        //
    }

    public function forceDelete(User $user, Disciplina $disciplina)
    {
        //
    }
}
