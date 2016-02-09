<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Proposition;
use App\Task;

class UserPolicy
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

    public function indexAccount(User $user)
    {
        if (is_executor_role($user) and $user->executant) return true;
        return false;
    }

    public function editAccount(User $user)
    {
        if (is_executor_role($user) and $user->executant) return true;
        return false;
    }

    public function createAccount(User $user)
    {
        if (is_executor_role($user) and !$user->executant) return true;
        return false;
    }

    public function createStudy(User $user)
    {
        if ($user->studies->count() < 5) {
            return true;
        }

        return false;
    }

    public function createExperience(User $user)
    {
        if ($user->experiences->count() < 5) {
            return true;
        }

        return false;
    }


}
