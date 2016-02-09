<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use App\Album;

class AlbumPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Album $album)
    {
        return $user->owns($album);
    }

    public function destroy(User $user, Album $album)
    {
        return $user->owns($album);
    }
}
