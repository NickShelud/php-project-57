<?php

namespace App\Policies;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TasksPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tasks $tasks): bool
    {
        return true;
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user): bool
    {
        return Auth::check();
    }

    public function delete(User $user, Tasks $task): bool
    {
        return Auth::check() && $task->created_by_id ===  $user->id;
    }
}
