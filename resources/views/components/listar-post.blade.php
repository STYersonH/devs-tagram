
<div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($posts as $post)
        <div>
            <!-- se pasa un objeto $post, pero ese se mapea y Laravel averigua lo necesario para el URL -->
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{  $post->imagen }}">
            </a>
        </div>
    @empty
        <p class="text-center">no hay posts, sigue a alguien para mostrar sus posts</p>
    @endforelse
</div>

<div class="mt-5">
    <!-- la paginacion va aqui -->
    {{ $posts->links() }}
</div>
