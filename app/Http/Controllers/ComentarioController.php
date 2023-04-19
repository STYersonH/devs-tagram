<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // validar
        $this->validate($request, [
            'comentario' => 'required|max:255',
        ]);

        // almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id, // estoy pasando el id del user que se autentico
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // imprimir un mensaje

        // return back() : para que regrese a la pagina anterior
        // with() : regresa con estos datos, se imprimen con una sesion
        return back()->with('mensaje', 'Comentario Realizado correctamente');
    }
}
