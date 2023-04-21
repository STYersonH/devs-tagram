<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // ATRIBUTOS
    public $mensaje = 'Hola mundo desde un atributo'; // ya esta disponible en la vista
    public $post; // dentro de las funciones se usara como $this->post
    // -- variables usadas para interactuar con las vistas
    public $isLiked;
    public $likes;

    // METODO QUE SE EJECUTARA AUTOMATICAMENTE
    // solamente cuando se monta el componente (cuando se click), pero no se actualiza hasta usar like()
    public function mount($post) // cuando sea instanciado, va a tomar un post
    {
        // en cuanto se llama el componente like-post al darse click, se manda a ejecutar este mount
        $this->isLiked = $post->checkLike(auth()->user()); // como un constructor
        $this->likes = $post->likes->count(); // asignamos un valor desde la BD que luego sera reactivo
    }

    // METODOS
    public function like()
    {
        // ya que el post que se pasa ya forma parte de la instancia, se usara this
        if ($this->post->checkLike(auth()->user())) {
            // -- aqui interactuamos con la BD
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            // -- en esta parte ya trabajamos con lo que se vera
            $this->isLiked = false; // aqui realizamos algo de reactividad
            --$this->likes;
        } else {
            // -- aqui interactuamos con la BD
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            // -- en esta parte ya trabajamos con lo que se vera
            $this->isLiked = true; // aqui realizamos algo de reactividad
            ++$this->likes;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
