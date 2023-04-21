<!-- directiva para usar el layout principal, siempre apuntan a views -->
@extends('layouts.app')

<!-- se inyecta el codigo dentro a donde esta 'titulo' -->
@section('titulo')
Pagina principal
@endsection

@section('contenido')
    <!--
    @ if($posts->count())
        @ foreach ($posts as $post)
            <h1>{ { $post->titulo } }</h1>
        @ endforeach
    @ else
        <p>no hay posts</p>
    @ endif
    -->
    <!-- lo mismo pero mejor -->
    <x-listar-post :posts="$posts" />
    
@endsection