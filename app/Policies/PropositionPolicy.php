<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Task;
use App\Proposition;

class PropositionPolicy
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

    public function showProposition(User $user, Proposition $proposition)
    {
        if ($user->id == $proposition->user_executant_id or
            $user->id == $proposition->task->user_customer_id) {
            return true;
        }
        return false;
    }

    public function acceptDealProposition(User $user, Proposition $proposition)
    {
        if ($proposition->is_confirmed == 1) {
            return true;
        }

        return false;
    }

    public function processDealProposition(User $user, Proposition $proposition)
    {
        if (is_customer_role($user)) return false;
        if ($proposition->is_confirmed == 0) {
            return true;
        }

        return false;
    }

    public function dissmisDealProposition(User $user, Proposition $proposition)
    {
        if ($proposition->is_confirmed == 2) {
            return true;
        }

        return false;
    }
}
