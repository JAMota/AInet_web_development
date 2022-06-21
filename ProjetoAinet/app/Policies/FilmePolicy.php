<?php

namespace App\Policies;

use App\Models\Filme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmePolicy
{
    use HandlesAuthorization;

            //o administrador tem acesso a este modelo e tem todas as permissoes
        //o funcionario pode ver of filmes para comfirmar que estas existem

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function before(User $user, $ability)
    {
        if ($user->tipo == 'A') {
            return true;
        }
    }


    public function viewAny(User $user)
    {
         //verificar se o user é administrador
         if($user->tipo == 'A'|| $user->tipo == 'F'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Filme $filme)
    {
         //verificar se o user é administrador
         if($user->tipo == 'A'|| $user->tipo == 'F'){
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
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Filme $filme)
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
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Filme $filme)
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
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Filme $filme)
    {
                        //verificar se o user é administrador
                        //extra para se fazer se ouver tempo
        if($user->tipo == 'A'){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filme  $filme
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Filme $filme)
    {
        //return false;
    }
}
