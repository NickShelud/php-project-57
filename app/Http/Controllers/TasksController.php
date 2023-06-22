<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use App\Models\TaskStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $tasks = Tasks::select('tasks.*', 'users.name as author', 'task_statuses.name as status')
            ->join('users', 'tasks.created_by_id', '=', 'users.id')
            ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
            ->paginate(15);
        


        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = new Tasks();
        $statuses = TaskStatuses::pluck('name', 'id');
        $performers = User::pluck('name', 'id');

        return view('task.create', compact('tasks', 'statuses', 'performers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $us = User::pluck('name', 'id');
        var_dump($us);
        $user = User::find(Auth::id())->name;
        
        $data = $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
        ]);

        $data['created_by_id'] = Auth::id();

        $task = new Tasks();
        $task->fill($data);
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($tasks)
    {
        $tasks = Tasks::findOrFail($tasks);
        $status = TaskStatuses::statusNameById($tasks->status_id)->all();

        return view('task.show', compact('tasks', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tasks)
    {
        $tasks = Tasks::findOrFail($tasks);

        $statuses = TaskStatuses::all();
        $users = User::all();
        $statuses = $statuses->reduce(function($acc, $status) {
            $acc[$status->id] = $status->name;
            return $acc;
        }, []);
        $performers = $users->reduce(function($acc, $status) {
            $acc[$status->id] = $status->name;
            return $acc;
        }, []);

        return view('task.edit', compact('tasks', 'statuses', 'performers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tasks)
    {
        $task = Tasks::findOrFail($tasks);

        $data = $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
        ]);

        $task->fill($data);
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tasks)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $task = Tasks::find($tasks);

        if ($task) {
            $task->delete();
        }

        return redirect()->route('tasks.index');
    }
}
