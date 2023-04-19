<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    // nos quedamos solo con delete, de entre todos
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
