<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // se ejecuta cuando se crea una instancia del controlador
    public function __construct()
    {
        // de esta manera revisara que el usuario este autenticado
        $this->middleware('auth'); // si no esta autenticado redireciona a login(byLaravel)
    }

    // al usar un route model binding, se espera un Model
    public function index(User $user)
    {
        // dd($user); //muestra la informacion del registro con ese id
        return view('dashboard', [
            'user' => $user, // llamo a dashboard y le paso $user
        ]);
    }

    // nos permite tener el formulario para visualizar
    public function create()
    {
        return view('posts.create');
    }

    // es el que almacena en la BD
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);
    }
}
