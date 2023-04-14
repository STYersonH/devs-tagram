<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image; // Facades : funciones que hacen algo particular

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // return 'Desde Imagen Controller'; //para comprobar que funciona el subir una imagen
        $imagen = $request->file('file');
        // $input = $request->all(); // leer todos los request
        // return response()->json($input); // el arreglo de inout se convierte en JSON

        // -- creear variable para generar un id unico para las imagenes
        $nombreImagen = Str::uuid().'.'.$imagen->extension();

        $imagenServidor = Image::make($imagen); // instancia de Intervation
        $imagenServidor->fit(1000, 1000);

        // el path de la imagen sera
        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        // guardar imagen en la ruta
        $imagenServidor->save($imagenPath);

        return response()->json(['Imagen' => $nombreImagen]); // se devolvera al archivo resources\js\app.js
    }
}
