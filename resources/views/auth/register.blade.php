@extends('layouts.app')

@section('titulo')
    Registrate en Devs-Tagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="rounded-2xl md:w-5/12 m-10 flex justify-center text-center">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de registro" class="rounded-2xl m-auto ">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-2xl shadow-lg">
            <form action="{{ route('register') }}" method="POST" novalidate> <!-- al ir alli aparede 419 | PAGE EXPIRED   -->
                @csrf <!-- para evitar este tipo de ataques -->
                <div class="mb-5">
                    <label for="name" class=" mb-2 block uppercase text-gray-500 font-bold ">
                        Nombre
                    </label>
                    <!-- value : ... para mantener el nombre anterior -->
                    <input 
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-xl @error('name') border-red-500 @enderror "
                        value="{{ old('name') }}" 
                    />
                    
                    <!-- error por validacion en el controlador -->
                    @error('name')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror

                </div>
                <div class="mb-5">
                    <label for="username" class=" mb-2 block uppercase text-gray-500 font-bold">
                        username
                    </label>
                    <input 
                        id="username"
                        type="text"
                        name="username"
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-xl @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}" 
                    />
                    @error('username')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="enail" class=" mb-2 block uppercase text-gray-500 font-bold">
                        email
                    </label>
                    <input 
                        id="emil"
                        type="email"
                        name="email"
                        placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-xl @error('email') border-red-500 @enderror"
                        value="{{ old('') }}" 
                    />
                    @error('email')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class=" mb-2 block uppercase text-gray-500 font-bold">
                        password
                    </label>
                    <input 
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Tu password"
                        class="border p-3 w-full rounded-xl @error('password') border-red-500 @enderror"
                        value="" 
                    />
                    @error('password')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class=" mb-2 block uppercase text-gray-500 font-bold">
                        repetir password
                    </label>
                    <input 
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="repite tu password"
                        class="border p-3 w-full rounded-xl @error('password_confirmation') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{$message }} </p> <!-- $message es automatico dependiendo del error -->
                    @enderror
                </div>

                <input type="submit" value="Crear cuenta" class="bg-sky-600 text-white p-2 w-full uppercase font-bold text-sm rounded-2xl">
            </form>
        </div>
    </div>
@endsection