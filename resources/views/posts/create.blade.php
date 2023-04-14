@extends('layouts.app')

@section('titulo')
    Crea una nueva publicacion
@endsection

<!-- apilar estos estilos -->
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <!-- border-dashed : border en puntos-->
            <!-- para subir imagenes se debe colcar enctype="multipart/form-data" para codificar adecuadamente las imagens -->
            <form 
                action="{{route('imagenes.store')}}" 
                method="POST"  
                enctype="multipart/form-data"
                id="dropzone" 
                class="dropzone border-dashed border-[3px] border-gray-300 w-full h-96 rounded-xl flex flex-col justify-center items-center text-xl text-gray-400"
            >
                @csrf <!-- solucionar problema al subir una imagen -->
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('register') }}" method="POST" novalidate> <!-- al ir alli aparede 419 | PAGE EXPIRED   -->
                @csrf <!-- para evitar este tipo de ataques -->
                <div class="mb-5">
                    <label for="titulo" class=" mb-2 block uppercase text-gray-500 font-bold ">
                        Titulo
                    </label>
                    <!-- value : ... para mantener el nombre anterior -->
                    <input 
                        id="titulo"
                        type="text"
                        name="titulo"
                        placeholder="Titulo de la publicacion"
                        class="border p-3 w-full rounded-xl @error('name') border-red-500 @enderror "
                        value="{{ old('titulo') }}" 
                    />
                    
                    <!-- error por validacion en el controlador -->
                    @error('titulo')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class=" mb-2 block uppercase text-gray-500 font-bold ">
                        Descripcion
                    </label>
                    <!-- value : ... para mantener el nombre anterior -->
                    <textarea 
                        id="descripcion"
                        name="descripcion"
                        placeholder="Descripcion de la publicacion"
                        class="border p-3 w-full rounded-xl @error('name') border-red-500 @enderror "
                    >{{ old('descripcion') }}</textarea> <!-- el cierre de textarea en laravel es obligatorio --> 
                    
                    <!-- error por validacion en el controlador -->
                    @error('descripcion')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>

                <input type="submit" value="Crear publicacion" class="bg-sky-600 text-white p-2 w-full uppercase font-bold text-sm rounded-2xl">
            </form>
        </div>
    </div>
@endsection