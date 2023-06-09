@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection


@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="w-8/12 lg:w-6/12 px-5 m-auto">
                <img 
                    src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" 
                    alt="imagen usuario"
                    class="rounded-full"
                >
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <div class="flex items-center gap-4">
                    <!-- $username mandado desde PostController -->
                    <p class="text-gray-700 font-bold">{{ $user->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a 
                                href="{{route('perfil.index')}}" 
                                class="text-gray-500 hover:text-gray-600 cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>                              
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Mostrar seguidores -->
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <!-- @ choice decidira que aplicar dependiendo del numero -->
                    <span class="font-normal"> @choice('seguidor|seguidores', $user->followers->count()) </span>
                </p>

                <!-- Mostrar cuentas seguidas -->
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-normal">Siguiendo</span>
                </p>

                <!-- Mostrar Post subidos -->
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->posts->count()}}
                    <span class="font-normal">Posts</span>
                </p>

                @auth <!-- a user not authenticated can't see -->
                @if ($user->id !== auth()->user()->id)
                    <!-- si no es seguidor entonces dar la opcion a dar seguir -->
                    @if( !$user->siguiendo( auth()->user() ))
                        <form 
                            action="{{ route('users.seguir', $user) }}"
                            method="POST"
                        >   <!-- $user is the person followed by us -->
                            @csrf <!-- evitar error 409 | expiro la conexion -->
                            <input 
                                type="submit"
                                class="bg-blue-600 text-white uppercase rounded-xl px-3 py-1 text-xs font-bold cursor-pointer"
                                value="follow"
                            >
                        </form>
                    @else
                        <form 
                            action="{{ route('users.no-seguir', $user) }}"
                            method="POST"
                        >
                            @csrf <!-- evitar error 409 | expiro la conexion -->
                            @method('DELETE')
                            <input 
                                type="submit"
                                class="bg-red-600 text-white uppercase rounded-xl px-3 py-1 text-xs font-bold cursor-pointer"
                                value="unfollow"
                            >
                        </form>
                    @endif
                @endif      
                @endauth
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