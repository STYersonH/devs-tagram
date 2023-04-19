<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // para que no lo vea un usuariono autenticado
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->merge(['username' => Str::slug($request->username)]); // antes de validar que sean diferentes

        $this->validate($request, [
            // , 'in:CLIENTE' forza a que se escoja alguno
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if ($request->imagen) {
            // return 'Desde Imagen Controller'; //para comprobar que funciona el subir una imagen
            $imagen = $request->file('imagen');
            // $input = $request->all(); // leer todos los request
            // return response()->json($input); // el arreglo de inout se convierte en JSON

            // -- creear variable para generar un id unico para las imagenes
            $nombreImagen = Str::uuid().'.'.$imagen->extension();

            $imagenServidor = Image::make($imagen); // instancia de Intervation
            $imagenServidor->fit(1000, 1000);

            // el path de la imagen sera
            $imagenPath = public_path('perfiles').'/'.$nombreImagen;
            // guardar imagen en la ruta
            $imagenServidor->save($imagenPath);
        }

        // guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        // si no hay un $nombreImagen toma el auth()... y sino hay uno toma ''
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
