<?php

namespace P4\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use P4\Movie;
use P4\User;

class MoviePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can create movies.
     *
     * @param  \P4\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the movie.
     *
     * @param  \P4\User  $user
     * @param  \P4\Movie  $movie
     * @return mixed
     */
    public function update(User $user, Movie $movie)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the movie.
     *
     * @param  \P4\User  $user
     * @param  \P4\Movie  $movie
     * @return mixed
     */
    public function delete(User $user, Movie $movie)
    {
        return $user->role === 'admin';
    }
}
