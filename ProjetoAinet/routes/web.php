<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [FilmeController::class, 'index'])->name('home');
Route::get('filmes/{filme}', [FilmeController::class, 'show'])->name('filmes.show');
Route::get('sessoes/{sessao}', [SessaoController::class, 'show'])->name('sessoes.show');
Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('carrinho/lugares/{sessao}/{lugar}', [CarrinhoController::class, 'store_bilhete'])->name('carrinho.store_bilhete');
Route::delete('carrinho/lugares/{$id}', [CarrinhoController::class, 'destroy_bilhete'])->name('carrinho.destroy_bilhete');
Route::post('carrinho', [CarrinhoController::class, 'confirmar'])->name('carrinho.confirmar')->middleware(['auth','verified','isBloqueado','isCliente']);
Route::delete('carrinho', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');

Route::middleware(['auth','verified','isBloqueado'])->prefix('admin')->name('admin.')->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

                            //carrinhoController ainda nao existe
    #Route::get('Checkout', 'carrinhoController' )->middleware('isCliente');

    //bloquear clientes
    Route::patch('users/{user}/bloqueado',[UserController::class, 'bloquear'])->name('bloqueado.update');


        // admininstração de generos
    Route::get('generos', [GeneroController::class, 'admin'])->name('generos')
        ->middleware('can:viewAny,App\Models\Genero');
    Route::get('generos/{genero}/edit', [GeneroController::class, 'edit'])->name('generos.edit')
        ->middleware('can:view,genero');
    Route::get('generos/create', [GeneroController::class, 'create'])->name('generos.create')
        ->middleware('can:create,App\Models\Genero');
    Route::post('generos', [GeneroController::class, 'store'])->name('generos.store')
        ->middleware('can:create,App\Models\Genero');
    Route::put('generos/{genero}', [GeneroController::class, 'update'])->name('generos.update')
        ->middleware('can:update,genero');
    Route::delete('generos/{genero}', [GeneroController::class, 'destroy'])->name('generos.destroy')
        ->middleware('can:delete,genero');

        // admininstração de salas
    Route::get('salas', [SalaController::class, 'admin'])->name('salas')
        ->middleware('can:viewAny,App\Models\Sala');
    Route::get('salas/{sala}/edit', [SalaController::class, 'edit'])->name('salas.edit')
        ->middleware('can:view,sala');
    Route::get('salas/create', [SalaController::class, 'create'])->name('salas.create')
        ->middleware('can:create,App\Models\Sala');
    Route::post('salas', [SalaController::class, 'store'])->name('salas.store')
        ->middleware('can:create,App\Models\Sala');
    Route::put('salas/{sala}', [SalaController::class, 'update'])->name('salas.update')
        ->middleware('can:update,sala');
    Route::delete('salas/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy')
        ->middleware('can:delete,sala');

    // filmes
    Route::get('filmes', [FilmeController::class, 'admin_index'])->name('filmes')
        ->middleware('can:viewAny,App\Models\Filme');
    Route::get('filmes/{filme}/edit', [FilmeController::class, 'edit'])->name('filmes.edit')
        ->middleware('can:view,filme');
    Route::get('filmes/create', [FilmeController::class, 'create'])->name('filmes.create')
        ->middleware('can:create,App\Models\Filme');
    Route::post('filmes', [FilmeController::class, 'store'])->name('filmes.store')
        ->middleware('can:create,App\Models\Filme');
    Route::put('filmes/{filme}', [FilmeController::class, 'update'])->name('filmes.update')
        ->middleware('can:update,filme');
    Route::delete('filmes/{filme}', [FilmeController::class, 'destroy'])->name('filmes.destroy')
        ->middleware('can:delete,filme');

                // admininstração de clientes
    Route::get('clientes', [ClienteController::class, 'admin'])->name('clientes')
    ->middleware('can:viewAny,App\Models\Cliente');
Route::get('clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit')
    ->middleware('can:view,cliente');
Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create')
    ->middleware('can:create,App\Models\Cliente');
Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store')
    ->middleware('can:create,App\Models\Cliente');
Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')
    ->middleware('can:update,cliente');
Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')
    ->middleware('can:delete,cliente');

    //administracao de passwords/Alterar password
    Route::get('users/password',[UserController::class, 'edit_password'])->name('password.edit');
    Route::patch('users/password',[UserController::class, 'update_password'])->name('password.update');
});

//login
Auth::routes(['verify'=>true]);

#register para todos os utilizadores nao autenticados
//TODO tirar este butao se o utilizadar estiver logado
Route::get('/registo', [ClienteController::class, 'create'])->name('registo');;
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes');;

#
//enviar mail de comfirmação e email com o pdf com receibos
Route::get('send-email', [MailController::class, 'index']);
#Route::get('send-email-pdf', [SendEmailController::class, 'index']);
