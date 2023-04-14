<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// Facades son funciones que hacen algo especifico, de ayuda para ciertas acciones
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // trajimos la funcion de web.php
    public function index()
    {
        return view('auth.register');
    }

    // $request es la informacion enviada desde la vista medinante el metodo
    // POST en routes/web.php
    public function store(Request $request)
    {
        // dd($request); // imprime lo que esta alli pero detiene la ejecucion de laravel
        // dd($request->get('name')); // atributo que se quiere ver del formulario

        // --- Modificar el request, (tratar de no hacerlo)
        // aqui esta agregando un campo username, con el valor valido de username
        // siento que habia un conflicto al haber 2 campos con 'username' pero parece que funciona

        $request->merge(['username' => Str::slug($request->username)]); // antes de validar que sean diferentes
        // $request->request->replace(['username' => Str::slug($request->username)]);
        // $request->request->add(['username' => Str::slug($request->username)]);

        // --- validacion en Laravel : aqui colocamos las reglas que debe cumplir cada campo ---
        $this->validate($request, [
            'name' => ['required', 'max:30', 'min:2'], // 'required|min:5'
            // ya hay una BD con la tabla users
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        // dd('Creando usuario');
        // --- Enviar la informacion a la BD
        User::create([
            'name' => $request->name,
            // lower : a minusculas
            // slug : a url (best option)
            'username' => $request->username,
            'email' => $request->email,
            // asi hashear los passwords
            'password' => Hash::make($request->password),
        ]);

        // --- Autenticar un usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // otra forma
        // auth()->attempt($request->only('email','password'))

        // --- Redireccionar
        return redirect()->route('posts.index');
    }
}
