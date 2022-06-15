<?php

namespace App\Policies;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocentePolicy
{
    use HandlesAuthorization;

   // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Docente" entity
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

    public function view(User $user, Docente $docente)
    {
        return $user->id == $docente->user_id;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Docente $docente)
    {
        return $user->id == $docente->user_id;
    }

    public function delete(User $user, Docente $docente)
    {
        return false;
    }

    public function restore(User $user, Docente $docente)
    {
        //
    }

    public function forceDelete(User $user, Docente $docente)
    {
        //
    }
}
