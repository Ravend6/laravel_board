<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Task;
use App\DealMessage;

class TaskPolicy
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

    public function createProposition(User $user, Task $task)
    {
        if (is_executor_role($user) and $task->status == 0) {
            if ($task->user_customer_id == $user->id) return false;
            foreach ($task->propositions as $proposition) {
                if ($proposition->user_executant_id == $user->id) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function createDeal(User $user, Task $task)
    {
        if ($task->status == 1) return false;
        if ($task->customer->id == $user->id) {
            return true;
        }

        return false;
    }

    public function updateDeal(User $user, Task $task)
    {
        if ($user->id == $task->user_executant_id) {
            return true;
        }

        return false;
    }
}
