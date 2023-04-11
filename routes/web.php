<?php

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
