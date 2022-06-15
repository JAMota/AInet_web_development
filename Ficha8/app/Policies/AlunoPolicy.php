<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlunoPolicy
{
    use HandlesAuthorization;

   // If user is admin, authorization check always return true
    // Admin user is granted all previleges over "Aluno" entity
    public function before($user, $ability)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return ($user->tipo == 'A') || ($user->tipo == 'D');
    }

    public function view(User $user, Aluno $aluno)
    {
        return ($user->tipo == 'D') || ($user->id == $aluno->user_id);
    }

    public function create(User $user)
    {
        return false;
        // It would be: return $user->admin;
        // If before method was not implemented
    }

    public function update(User $user, Aluno $aluno)
    {
        return $user->id == $aluno->user_id;
    }

    public function delete(User $user, Aluno $aluno)
    {
        return false;
        // It would be: return $user->admin;
        // If before method was not implemented
    }

    public function restore(User $user, Aluno $aluno)
    {
        //
    }

    public function forceDelete(User $user, Aluno $aluno)
    {
        //
    }
}
