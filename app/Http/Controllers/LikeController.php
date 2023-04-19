<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // dd($request->user()->id); // asi obtenemos el id de quien dio el like
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        // obtenemos los likes del user que solicito(dio click en el corazon) y elimina el like con las caracteristicas
        $request->user()->likes()->where('post_id', $post->id)->delete();
        // regresar a la misma pantalla
        return back();
    }
}
