<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('site');

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::resource('/eixo', 'App\Http\Controllers\EixoController');
Route::resource('/nivel', 'App\Http\Controllers\NivelController');
Route::resource('/curso', 'App\Http\Controllers\CursoController');
Route::resource('/aluno', 'App\Http\Controllers\AlunoController');
Route::resource('/turma', 'App\Http\Controllers\TurmaController');
Route::resource('/user', 'App\Http\Controllers\UserController');
Route::resource('/categoria', 'App\Http\Controllers\CategoriaController');
Route::resource('/comprovante', 'App\Http\Controllers\ComprovanteController');
Route::resource('/declaracao', 'App\Http\Controllers\DeclaracaoController');
