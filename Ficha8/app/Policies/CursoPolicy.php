<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CursoPolicy
{
    use HandlesAuthorization;

       // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Curso" entity
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

    public function view(User $user, Curso $curso)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Curso $curso)
    {
        return false;
    }

    public function delete(User $user, Curso $curso)
    {
        return false;
    }

    public function restore(User $user, Curso $curso)
    {
        //
    }

    public function forceDelete(User $user, Curso $curso)
    {
        //
    }
}
