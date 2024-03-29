<?php

namespace App\Http\Controllers;

use App\Models\TaskStatuses;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskStatusesRequest;
use App\Http\Requests\UpdateTaskStatusesRequest;

class TaskStatusesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatuses::class, 'task_status', [
            'except' => ['index'],
        ]);
    }
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
        $status = new TaskStatuses();

        return view('status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusesRequest $request)
    {
        $data = $request->validated();
        flash(__('trans.flash.statusCreate'))->success();

        $status = new TaskStatuses();
        $status->fill($data);
        $status->save();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatuses $taskStatus)
    {
        return view('status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusesRequest $request, TaskStatuses $taskStatus)
    {
        $data = $request->validated();
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
        $task = Tasks::where('status_id', $taskStatus->id)->exists();

        if ($taskStatus->tasks()->exists()) {
            flash(__('trans.flash.statusNotDelete'))->error();
            return back();
        }

        $taskStatus->delete();
        flash(__('trans.flash.statusDelete'))->success();

        return redirect()->route('task_statuses.index');
    }
}
