<?php

namespace App\Http\Controllers;

use App\Models\TaskStatuses;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class TaskStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = TaskStatuses::paginate();

        return view('status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $status = new TaskStatuses();

        return view('status.create', compact('status'));
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
            'name' => 'required|unique:task_statuses'
        ]);

        flash(__('trans.flash.statusCreate'))->success();

        $status = new TaskStatuses();
        $status->fill($data);
        $status->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskStatuses $taskStatuses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatuses $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        return view('status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatuses $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name',
        ]);

        flash(__('trans.flash.statusUpdate'))->success();

        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatuses $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $task = Tasks::where('status_id', $taskStatus->id)->exists();

        if ($task) {
            flash(__('trans.flash.statusNotDelete'))->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();
        flash(__('trans.flash.statusDelete'))->success();

        return redirect()->route('task_statuses.index');
    }
}
