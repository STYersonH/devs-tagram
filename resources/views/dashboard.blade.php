@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection


@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="w-8/12 lg:w-6/12 px-5 m-auto">
                <img src="{{asset('img/usuario.svg')}}" alt="imagen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <!-- $username mandado desde PostController -->
                <p class="text-gray-700 font-bold">{{ $user->username }}</p>

                <!-- Mostrar seguidores -->
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>

                <!-- Mostrar cuentas seguidas -->
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>

                <!-- Mostrar Post subidos -->
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- iterar entre los posts -->
                @foreach ($posts as $post)
                    <div>
                        <!-- se pasa un objeto $post, pero ese se mapea y Laravel averigua lo necesario para el URL -->
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{  $post->imagen }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-5">
                <!-- la paginacion va aqui -->
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
        
        
    </section>

@endsection