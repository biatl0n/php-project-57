<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $taskExecutors = User::pluck('name', 'id');
        return view('tasks.create', compact('task', 'taskStatuses', 'taskExecutors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tasks',
            'description' => 'nullable|string|max:1000',
            'status_id' => 'required|integer|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|integer|exists:users,id'
        ], ['name.unique' => __('tasks.already-exists')]);
        $task = new Task();
        $task->createdBy()->associate(Auth::user());
        $task->fill($data);
        $task->save();
        flash(__('tasks.created-successfully'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $taskExecutors = User::pluck('name', 'id');
        return view('tasks.edit', compact('task', 'taskStatuses', 'taskExecutors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tasks,name,' . $task->id,
            'description' => 'nullable|string|max:1000',
            'status_id' => 'required|integer|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|integer|exists:users,id'
        ], ['name.unique' => __('tasks.already-exists')]);

        $task->fill($data);
        $task->save();
        flash(__('tasks.changed-successfully'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);
        $task->delete();
        flash(__('tasks.deleted-successfully'))->success();
        return redirect()->route('tasks.index');
    }
}
