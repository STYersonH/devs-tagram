<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function __construct()
    {
        // para ver la pg principal tiene que autenticarse
        $this->middleware('auth'); // si el user no esta autenticado redirige a la pagina de iniciar sesion
    }

    // public function index() -- se reemplazara por invoke ya que solo habra un metodo en esta clase
    public function __invoke()
    {
        // Obtener a quien seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray(); // pluck : para determinar que queremos de followings
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20); // whereIn usa el arreglo $ids y captura esos ides y los trae
        // latest ordenara las publicaciones por fechas

        // dd($posts);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
