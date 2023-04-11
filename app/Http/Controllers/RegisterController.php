<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // trajimos la funcion de web.php
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request); // imprime lo que esta alli pero detiene la ejecucion de laravel
        // dd($request->get('name')); // atributo que se quiere ver del formulario

        // --- validacion en Laravel : aqui colocamos las reglas que debe cumplir cada campo ---
        $this->validate($request, [
            'name' => ['required', 'max:30', 'min:2'], // 'required|min:5'
            // ya hay una BD con la tabla users
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
    }
}
