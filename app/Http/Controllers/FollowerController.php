<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowerController extends Controller
{
    // $user is the person followed by us
    // our user information is in $request
    public function store(User $user)
    {
        // atach cuando tenemos una relacion de muchos a muchos
        // atach cuando se relaciona una tabla con si misma
        // - se accede a la tabla followers, gracias a la declaracion en User el metodo followers()
        // permitiendo que al usar attach() se coloque el id de user en el primer campo (user_id) y el
        // del usuario entregado como argumento a attach en el segundo campo (followed_id)
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
