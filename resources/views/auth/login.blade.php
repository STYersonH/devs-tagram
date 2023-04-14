@extends('layouts.app')

@section('titulo')
    Inicia sesion en Devs-Tagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="rounded-2xl md:w-5/12 m-10 flex justify-center text-center">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login" class="rounded-2xl m-auto ">
        </div>

        <div class="h-auto md:w-4/12 bg-white p-6 rounded-2xl shadow-lg ">
            <form method="POST" action="{{ route('login') }}" novalidate> <!-- al ir alli aparede 419 | PAGE EXPIRED   -->
                @csrf <!-- para evitar este tipo de ataques -->
                
                <!-- mensaje de LoginController : una forma de consumir datos desde el controlador-->
                @if(session('mensaje'))
                    <p class=" bg-red-500 text-white my-1 rounded-xl text-sm p-2 text-center"> {{ session('mensaje') }} </p> 
                @endif

                <div class="mb-5">
                    <label for="email" class=" mb-2 block uppercase text-gray-500 font-bold">
                        email
                    </label>
                    <input 
                        id="emil"
                        type="email"
                        name="email"
                        placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-xl @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" 
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
                    <input type="checkbox" name="remember"> 
                    <label class=" text-gray-500 text-sm ">Mantener mi sesion abierta</label>
                </div>

                <input type="submit" value="Iniciar sesion" class="bg-sky-600 text-white p-2 w-full uppercase font-bold text-sm rounded-2xl">
            </form>
        </div>
    </div>
@endsection