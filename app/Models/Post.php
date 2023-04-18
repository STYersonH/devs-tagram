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
}
