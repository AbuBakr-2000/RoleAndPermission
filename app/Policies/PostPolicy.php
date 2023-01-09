<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Post $postsAdmin)
    {
//        return $user->id === $postsAdmin->user_id;
    }

    public function create(User $user)
    {
        return $user->is($user);
    }

    public function update(User $user, Post $postsAdmin)
    {
        return $user->id === $postsAdmin->user_id;
    }

    public function delete(User $user, Post $postsAdmin)
    {
        return $user->id === $postsAdmin->user_id;
    }

    public function restore(User $user, Post $postsAdmin)
    {
        //
    }

    public function forceDelete(User $user, Post $postsAdmin)
    {
        //
    }
}
