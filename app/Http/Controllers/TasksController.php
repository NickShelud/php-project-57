<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use App\Models\TaskStatuses;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();

        $tasks = QueryBuilder::for(Tasks::class)
            ->allowedFilters(
                [
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id')
                ]
            )
            ->paginate(15);

        $users = User::pluck('name', 'id');
        $statuses = TaskStatuses::pluck('name', 'id');

        $filter = $request->filter ?? null;


        return view('task.index', compact('tasks', 'users', 'statuses', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $task = new Tasks();
        $statuses = TaskStatuses::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $data = $this->validate($request, [
            'name' => 'required|max:255|unique:tasks,name',
            'status_id' => 'required',
            'description' => 'nullable|max:255',
            'assigned_to_id' => 'nullable',
            'label_id' => 'nullable'
        ]);

        flash(__('trans.flash.taskCreate'))->success();

        $data['created_by_id'] = Auth::id();

        $task = new Tasks();
        $task->fill($data);
        $task->save();

        return redirect()->secure(route('tasks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasks $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $task)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $statuses = TaskStatuses::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $task)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $data = $this->validate($request, [
            'name' => 'required|max:255|unique:tasks,name',
            'status_id' => 'required',
            'description' => 'nullable|max:255',
            'assigned_to_id' => 'nullable',
            'label_id' => 'nullable'
        ]);

        flash(__('trans.flash.taskUpdate'))->success();

        $task->fill($data);
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $task)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $task->delete();
        flash(__('trans.flash.taskDelete'))->success();

        return redirect()->route('tasks.index');
    }
}
