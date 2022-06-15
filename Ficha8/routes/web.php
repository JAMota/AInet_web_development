<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\CandidaturaController;

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

//Rotas de frontend
Route::get("/", [PageController::class, 'index'])->name('home');
Route::get("/disciplinas", [DisciplinaController::class, 'index'])->name('disciplinas.index');
Route::get("/cursos", [CursoController::class, 'index'])->name('cursos.index');
Route::get("/docentes", [DocenteController::class, 'index'])->name('docentes.index');
Route::get("/candidaturas", [CandidaturaController::class, 'create'])->name('candidaturas.index');
Route::post('candidaturas', [CandidaturaController::class, 'store'])->name('candidaturas.store');


Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // disciplinas
    Route::get('disciplinas', [DisciplinaController::class, 'admin_index'])->name('disciplinas')
        ->middleware('can:viewAny,App\Models\Disciplina');
    Route::get('disciplinas/{disciplina}/edit', [DisciplinaController::class, 'edit'])->name('disciplinas.edit')
        ->middleware('can:view,disciplina');
    Route::get('disciplinas/create', [DisciplinaController::class, 'create'])->name('disciplinas.create')
        ->middleware('can:create,App\Models\Disciplina');
    Route::post('disciplinas', [DisciplinaController::class, 'store'])->name('disciplinas.store')
        ->middleware('can:create,App\Models\Disciplina');
    Route::put('disciplinas/{disciplina}', [DisciplinaController::class, 'update'])->name('disciplinas.update')
        ->middleware('can:update,disciplina');
    Route::delete('disciplinas/{disciplina}', [DisciplinaController::class, 'destroy'])->name('disciplinas.destroy')
        ->middleware('can:delete,disciplina');


    // admininstração de cursos
    Route::get('cursos', [CursoController::class, 'admin'])->name('cursos')
        ->middleware('can:viewAny,App\Models\Curso');
    Route::get('cursos/{curso}/edit', [CursoController::class, 'edit'])->name('cursos.edit')
        ->middleware('can:view,curso');
    Route::get('cursos/create', [CursoController::class, 'create'])->name('cursos.create')
        ->middleware('can:create,App\Models\Curso');
    Route::post('cursos', [CursoController::class, 'store'])->name('cursos.store')
        ->middleware('can:create,App\Models\Curso');
    Route::put('cursos/{curso}', [CursoController::class, 'update'])->name('cursos.update')
        ->middleware('can:update,curso');
    Route::delete('cursos/{curso}', [CursoController::class, 'destroy'])->name('cursos.destroy')
        ->middleware('can:delete,curso');

    // admininstração de docentes
    Route::get('docentes', [DocenteController::class, 'admin'])->name('docentes')
        ->middleware('can:viewAny,App\Models\Docente');
    Route::get('docentes/{docente}/edit', [DocenteController::class, 'edit'])->name('docentes.edit')
        ->middleware('can:view,docente');
    Route::get('docentes/create', [DocenteController::class, 'create'])->name('docentes.create')
        ->middleware('can:create,App\Models\Docente');
    Route::post('docentes', [DocenteController::class, 'store'])->name('docentes.store')
        ->middleware('can:create,App\Models\Docente');
    Route::put('docentes/{docente}', [DocenteController::class, 'update'])->name('docentes.update')
        ->middleware('can:update,docente');
    Route::delete('docentes/{docente}', [DocenteController::class, 'destroy'])->name('docentes.destroy')
        ->middleware('can:delete,docente');
    Route::delete('docentes/{docente}/foto', [DocenteController::class, 'destroy_foto'])->name('docentes.foto.destroy')
        ->middleware('can:update,docente');

    // admininstração de alunos
    Route::get('alunos', [AlunoController::class, 'admin'])->name('alunos')
        ->middleware('can:viewAny,App\Models\Aluno');
    Route::get('alunos/{aluno}/edit', [AlunoController::class, 'edit'])->name('alunos.edit')
        ->middleware('can:view,aluno');
    Route::get('alunos/create', [AlunoController::class, 'create'])->name('alunos.create')
        ->middleware('can:create,App\Models\Aluno');
    Route::post('alunos', [AlunoController::class, 'store'])->name('alunos.store')
        ->middleware('can:create,App\Models\Aluno');
    Route::put('alunos/{aluno}', [AlunoController::class, 'update'])->name('alunos.update')
        ->middleware('can:update,aluno');
    Route::delete('alunos/{aluno}', [AlunoController::class, 'destroy'])->name('alunos.destroy')
        ->middleware('can:delete,aluno');
    Route::delete('alunos/{aluno}/foto', [AlunoController::class, 'destroy_foto'])->name('alunos.foto.destroy')
        ->middleware('can:update,aluno');
});

Auth::routes(['register' => false, 'verify'=>true]);
