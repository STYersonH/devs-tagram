<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// importar Post

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username', // agregado recientemente para poder usarlo
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // sigue las convenciones
    public function posts()
    {
        // relation one to many
        return $this->hasMany(Post::class);
    }

    // sigue las convenciones
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // no sigue las convenciones
    // Almacena los seguidores de un usuario
    public function followers()
    {
        // un usuario puede tener seguidores con varios usuarios
        // el metodo followers en la tabla de followers pertenece a muchos usuarios
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Almacenar los que seguimos
}
