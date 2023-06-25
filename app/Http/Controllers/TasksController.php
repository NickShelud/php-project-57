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
        $tasks = Tasks::select('tasks.*', 'users.name as author', 'task_statuses.name as status', 'users.name as performer')
            ->join('users', 'tasks.created_by_id', '=', 'users.id')
            ->join('task_statuses', 'tasks.status_id', '=', 'task_statuses.id')
            ->leftjoin('users as performers', 'tasks.assigned_to_id', '=', 'performers.id')
            ->paginate(15);
        


        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $tasks = new Tasks();
        $statuses = TaskStatuses::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('task.create', compact('tasks', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $user = User::find(Auth::id())->name;
        
        $data = $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable'
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
        if (Auth::user() === null) {
            abort(403);
        }
        $tasks = Tasks::findOrFail($tasks);

        $statuses = TaskStatuses::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('task.edit', compact('tasks', 'statuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tasks)
    {
        if (Auth::user() === null) {
            abort(403);
        }
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
