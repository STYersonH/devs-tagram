<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    // creando la variable de posts que se usara luego
    public $posts;

    /**
     * Create a new component instance.
     */
    // recibe lo que se paso desde la vista
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.listar-post');
    }
}
