<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

// visito esta url y realizo lo que hay en la funcion
Route::get('/', function () {
    return view('principal');
});

// la funcion se envio al controlador registerController
// es importante imoprtar el controlador
// por convencion el que se muestra la vista debe ser index
// el controlador llama a la vista

// al usar ->name('register') ya no tengo que preocuparme por las rutas bien colocadas
// ya se pueden llamar como deseemos, y evitar problemas
Route::get('/register', [RegisterController::class, 'index'])->name('register');
// get : cuando visitamos un sitio
Route::post('/register', [RegisterController::class, 'store']);
// post : cuando enviamos un formulario

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']); // enviar informacion al servidor
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// cuando esta entre llaves es una variable, User es un model
// si colocamos el nombre del model, estamos usando un "route model binding"
// user es el id (1, 20, 22, 14, ...)
// user:username sera el username del registro que se buscara
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
// el metodo para crear sera create
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// Get : visitamos una URL
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::post('imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
