@extends('layouts.app')

@section('titulo')
    {{$post->titulo}} 
@endsection


@section('contenido')
    <div class="container mx-auto flex justify-center">
        <div class="md:w-2/5">
            <img src="{{asset('uploads') . '/'. $post->imagen}}" alt="imagen del post {{$post->titulo}}">
            <div class="p-3">
                <p>0 likes</p>
            </div>
            <div>
                <!-- $post->user proviene de la definicion de muchos a uno que hicimos para el modelo -->
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    <!-- gracias a la api para fechas Carbon, integrada en Laravel, manejo de fechas -->
                    {{$post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{$post->descripcion}}
                </p>
            </div>
        </div>
        <div class="md:w-2/5 p-5">
            <div class="shadow bg-white p-5 rounded-xl">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo comentario</p>

                <form action="">
                    <div class="mb-5">
                        <label for="comentario" class=" mb-2 block uppercase text-gray-500 font-bold ">
                            agrega un comentario
                        </label>
                        <!-- value : ... para mantener el nombre anterior -->
                        <textarea 
                            id="comentario"
                            name="comentario"
                            placeholder="Agrega un comentario"
                            class="border p-3 w-full rounded-xl @error('name') border-red-500 @enderror "
                        ></textarea> <!-- el cierre de textarea en laravel es obligatorio --> 
                        
                        <!-- error por validacion en el controlador -->
                        @error('comentario')
                            <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                        @enderror
                    </div>

                    <input type="submit" value="Comentar" class="bg-sky-600 text-white p-2 w-full uppercase font-bold text-sm rounded-2xl">
                </form>
                @endauth
            </div>
        </div>
    </div>
@endsection