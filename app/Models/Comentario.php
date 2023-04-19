<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Comentario extends Model
{
    use HasFactory;

    // para poder almacenar esos campos en la BD
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
