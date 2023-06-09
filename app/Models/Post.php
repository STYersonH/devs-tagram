<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // hacer esto para evitar el error de
    //  Add [titulo] to fillable property to allow mass assignment on [App\Models\Post]
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user() // siguiendo convenciones de laravel
    {
        // return $this->belongsTo(User::class); // relation Belongs to
        // cargar la consulta con informacion innecesaria
        return $this->belongsTo(User::class)->select(['name', 'username']); // traer solo name y username
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        // revisa cualquiera si se contiene en la columna user_id el id del usuario
        return $this->likes->contains('user_id', $user->id);
    }
}
