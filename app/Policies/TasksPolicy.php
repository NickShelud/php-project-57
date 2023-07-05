<?php

namespace App\Policies;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TasksPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Tasks $task): bool
    {
        return Auth::check() && $task->created_by_id ===  $user->id;
    }
}
