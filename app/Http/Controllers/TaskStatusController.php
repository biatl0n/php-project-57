<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $statuses = ['new', 'finish', 'На тестировании', 'В архиве'];
        foreach ($statuses as $status) {
            if (!TaskStatus::whereName($status)->exists()) {
                TaskStatus::factory()->create(['name' => $status]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(15);
        return view('task-status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task-status.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:task_statuses',
        ], ['name.unique' => __('task-status.already-exists')]);
        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('task-status.created-successfully'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        return view('task-status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
            ], ['name.unique' => __('task-status.already-exists')]);
        $taskStatus->fill($data);
        $taskStatus->save();
        flash(__('task-status.changed-successfully'))->success();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        if ($taskStatus->tasks()->count() == 0) {
            $taskStatus->delete();
            flash(__('task-status.deleted-successfully'))->success();
        } else {
            flash(__('task-status.deleted-fail-is-used'))->error();
        }
        return redirect()->route('task_statuses.index');
    }
}
