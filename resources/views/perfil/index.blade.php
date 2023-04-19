@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <!-- enctype="multipart/form-data" por que subiremos una imagen -->
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold ">
                        Username
                    </label>
                    <!-- value : ... para mantener el nombre anterior -->
                    <input 
                        id="username"
                        type="text"
                        name="username"
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-xl @error('username') border-red-500 @enderror "
                        value="{{ auth()->user()->username }}" 
                    />
                    
                    <!-- error por validacion en el controlador -->
                    @error('username')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>
                <!-- imagen perfil -->
                <div class="mb-5">
                    <label for="imagen" class=" mb-2 block uppercase text-gray-500 font-bold ">
                        Imagen perfil
                    </label>
                    <!-- value : ... para mantener el nombre anterior -->
                    <input 
                        id="imagen"
                        type="file"
                        name="imagen"
                        class="border p-3 w-full rounded-xl"
                        accept=".jpg, .jpeg, .png"
                    />
                </div>
                <input type="submit" value="Save changes" class="bg-sky-600 text-white p-2 w-full uppercase font-bold text-sm rounded-2xl">

            </form>
        </div>
    </div>
@endsection