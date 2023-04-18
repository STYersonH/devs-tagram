<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // se ejecuta cuando se crea una instancia del controlador
    public function __construct()
    {
        // de esta manera revisara que el usuario este autenticado
        $this->middleware('auth')->except(['show', 'index']); // si no esta autenticado redireciona a login(byLaravel)
        // except permite proteger excepto ciertos metodos
    }

    // al usar un route model binding, se espera un Model
    public function index(User $user)
    {
        // estamos capturando los posts del usuario dado
        $posts = Post::where('user_id', $user->id)->paginate(4); // para paginar en la vista
        // $posts = Post::where('user_id', $user->id)->get();

        // dd($user); //muestra la informacion del registro con ese id
        return view('dashboard', [
            'user' => $user, // llamo a dashboard y le paso $user
            'posts' => $posts, // se le pasa a la vista los posts
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

        // crear la informacion de un post estructurada y la sube a la BD
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        // otra forma de hacer esto
        /*
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();*/

        // Otra forma mas al estilo de Laravel
        /*
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);*/

        // una vez creado el post redirijir al perfil
        return redirect()->route('posts.index', auth()->user()->username);
    }

    // show : se usa para mostrar un recurso
    // al ser un route model binding recibe un $post, que se puede usar aqui
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
