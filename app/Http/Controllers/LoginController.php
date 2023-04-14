<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd('Autenticando...');
        // dd($request->remember);

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // verificar si los datos son correctos
        // $request->remember corrogora el checkbox para mantener la sesion abierta para siempre
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // si el usuario no se puede autenticar
            // back() : devuelve a la pagina anterior visitada
            // with() : usa la sesion flash para almacenar un mensaje que se mostrara
            return back()->with('mensaje', 'credenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
