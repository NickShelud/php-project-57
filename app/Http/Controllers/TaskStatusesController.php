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
            'name' => 'required|max:20|unique:task_statuses'
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
    public function edit($taskStatuses)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $status = TaskStatuses::findOrFail($taskStatuses);

        return view('status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $taskStatuses)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $status = TaskStatuses::findOrFail($taskStatuses);
        

        $data = $this->validate($request, [
            'name' => 'required|max:20|unique:task_statuses,name'. $status->id,
        ]);

        if($data) {
            flash(__('trans.flash.statusUpdate'))->success();
        } else {
            flash('Not update')->error();
        }
        
        $status->fill($data);
        $status->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($taskStatuses)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $status = TaskStatuses::find($taskStatuses);

        $taskStatusId = Tasks::where('status_id', $taskStatuses)->get();

        if (!$taskStatusId and $status) {
            $status->delete();
            flash(__('trans.flash.statusDelete'))->success();
        } else {
            flash(__('trans.flash.statusNotDelete'))->error();
        }

        return redirect()->route('task_statuses.index');
    }
}
