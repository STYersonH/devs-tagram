<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--  apilar estilos CSS, los cuales pueden ser agregados desde cualquier momento y diferentes ubicaciones -->
    @stack('styles')

    <title>Devs-tagram </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- para agregar los estilos de tailwind -->
    @vite('resources/css/app.css')
    <!-- para que se apliquen las cosas de js a nuestro HTML -->
    @vite('resources/js/app.js')
</head>

<body class=" bg-gray-100">
    <header class=" p-5 border-b bg-white font-black">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">Devs-tagram</h1>
            
            <!-- una forma de usar la restriccion de autenticacion para mostrar HTML -->
            @if(auth()->user())
                <p>Autenticado</p>
            @else
                <p>No autenticado</p>
            @endif

            <!-- mostrar en caso de estar autenticado -->
            @auth
                <nav class="flex items-center gap-4">
                    <a href="{{route('posts.create')}}" class="flex items-center gap-2 bg-white border text-gray-600 rounded-2xl text-sm uppercase font-bold cursor-pointer px-3 py-1 hover:bg-gray-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>                          
                        Crear
                    </a>
                    <a href="{{route('posts.index', auth()->user()->username)}}" class="font-bold text-gray-600 text-sm">
                        Hola: 
                        <span class="font-normal"> 
                            {{auth()->user()->username}} 
                        </span> 
                    </a>
                    <!-- cerrar sesion de manera mas segura -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf <!-- directiva para evitar ataques -->
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar sesion</button>
                    </form>
                </nav>
            @endauth

            <!-- mostrar en caso de no estar autenticado -->
            @guest
                <nav class="flex gap-2">
                    <a href="#" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                    <!-- a route le pasamos alguna ruta registrada, toma el nombre y no la url como tal -->
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
                </nav>
            @endguest
            
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
           @yield('titulo') 
        </h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Devs-tagram - Todos los derechos reservados {{ now()->year }}
    </footer>
</body>

</html>