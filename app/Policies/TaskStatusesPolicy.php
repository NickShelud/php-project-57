<?php

namespace App\Policies;

use App\Models\TaskStatuses;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TaskStatusesPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (Auth::check() === false) {
            return abort(403);
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskStatuses $taskStatuses): bool
    {
        if (Auth::check() === false) {
            return abort(403);
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskStatuses $taskStatuses): bool
    {
        if (Auth::check() === false) {
            return abort(403);
        }
    }
}
