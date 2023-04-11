<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Devs-tagram </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- para agregar los estilos de tailwind -->
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">
    <header class=" p-5 border-b bg-white font-black">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">Devs-tagram</h1>
            <nav class="flex gap-2">
                <a href="#" class="font-bold uppercase text-gray-600 text-sm">Login</a>
                <!-- a route le pasamos alguna ruta registrada, toma el nombre y no la url como tal -->
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
            </nav>
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