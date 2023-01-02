<?php

use App\Http\Controllers\ApiUsuariosController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrarController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/crear-cuenta',[RegistrarController::class, 'index'])->name('registrar');
Route::post('/crear-cuenta',[RegistrarController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout',[LogoutController::class, 'store'])->name('cerrar-sesion');

//rutas para el perfil

Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/post/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Likes de las fotos

Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

Route::post('/{user:username}/follower', [FollowerController::class, 'store'])->name('users.follower');
Route::delete('/{user:username}/unfollower', [FollowerController::class, 'destroy'])->name('users.unfollower');


Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

Route::get('/api/usuarios', [ApiUsuariosController::class, 'index']);