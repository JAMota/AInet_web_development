<?php

namespace App\Policies;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneroPolicy
{
    use HandlesAuthorization;

    //apenas o administrador tem acesso a este modelo e tem todas as permissoes

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //verificar se o user é administrador
        if($user->tipo == 'A'){
            return true;
        }

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Genero $genero)
    {
                //verificar se o user é administrador
        if($user->tipo == 'A'){
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
                //verificar se o user é administrador
                if($user->tipo == 'A'){
                    return true;
                }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Genero $genero)
    {
               //verificar se o user é administrador
               if($user->tipo == 'A'){
                return true;
            }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Genero $genero)
    {
                //verificar se o user é administrador
                if($user->tipo == 'A'){
                    return true;
                }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Genero $genero)
    {
        return;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Genero $genero)
    {
        return false;
    }
}
