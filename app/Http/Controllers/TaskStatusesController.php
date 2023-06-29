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

        if($data) {
            flash(__('trans.flash.statusCreate'))->success();
        } else {
            flash('Not create')->error();
        }

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
    public function edit(TaskStatuses $taskStatuses)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        
        return view('status.edit', compact('taskStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskStatuses $taskStatuses)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name'. $taskStatuses->id,
        ]);

        if($data) {
            flash(__('trans.flash.statusUpdate'))->success();
        } else {
            flash('Not update')->error();
        }
        
        $taskStatuses->fill($data);
        $taskStatuses->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatuses $taskStatuses)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $taskStatusId = Tasks::where('status_id', $taskStatuses->status_id)->exists();

        if ($taskStatusId) {
            flash(__('trans.flash.statusNotDelete'))->error();
            return redirect()->route('task_statuses.index');
        }
        
        $taskStatuses->delete();
        flash(__('trans.flash.statusDelete'))->success();

        return redirect()->route('task_statuses.index');
    }
}
