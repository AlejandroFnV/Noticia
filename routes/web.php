<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FrontendNoticiaController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\ComentarioNoticiaController;
use App\Http\Controllers\IndexController;

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

//Frontend
Route::get('/', [FrontendNoticiaController::class, 'index'])->name('frontend.main');
Route::get('single/{noticia}', [FrontendNoticiaController::class, 'single'])->name('frontend.single');
Route::get('single/autor/{author}', [AutorController::class, 'autorNoticias'])->name('frontend.single.autor');
Route::resource('single/{noticia}/comentario', ComentarioNoticiaController::class, ['names' => 'single.comentario'])->only(['store']);

//Backend
Route::get('backend', [BackendController::class, 'main'])->name('backend.main');
Route::resource('backend/noticia', NoticiaController::class, ['names' => 'backend.noticia']);
Route::resource('backend/comentario', ComentarioController::class, ['names' => 'backend.comentario']);
Route::get('backend/comentario/{idnoticia}/comentarios', [ComentarioController::class, 'verComentarios'])->name('backend.comentario.verComentarios');

//Paginacion
Route::get('backend/noticia/paginate/index', [NoticiaController::class, 'paginate'])->name('backend.noticia.paginate.index');
Route::get('backend/comentario/paginate/index', [ComentarioController::class, 'paginate'])->name('backend.comentario.paginate.index');