<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // para poder almacenar esos campos en la BD
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario',
    ];
}
