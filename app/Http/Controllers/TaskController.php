<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $taskExecutors = User::pluck('name', 'id');
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                'status_id',
                'created_by_id',
                'assigned_to_id'
            ])
            ->paginate(15)->appends($request->query());
        return view('tasks.index', compact('tasks', 'taskStatuses', 'users', 'taskExecutors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        $labels = Label::pluck('name', 'id');
        $taskStatuses = TaskStatus::pluck('name', 'id');
        $taskExecutors = User::pluck('name', 'id');
        return view('tasks.create', compact('task', 'taskStatuses', 'taskExecutors', 'labels'));
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
            'assigned_to_id' => 'nullable|integer|exists:users,id',
            'labels' => 'nullable|array',
            'labels.*' => 'integer|exists:labels,id',
        ], ['name.unique' => __('tasks.already-exists')]);
        $task = new Task();
        $task->createdBy()->associate(Auth::user());
        $task->fill($data);
        $task->save();

        if (!empty($data['labels'])) {
            $timestamps = ['created_at' => now(), 'updated_at' => now()];
            $task->labels()->attach(array_fill_keys($data['labels'], $timestamps));
        }

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
        $labels = Label::pluck('name', 'id');
        return view('tasks.edit', compact('task', 'taskStatuses', 'taskExecutors', 'labels'));
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
            'assigned_to_id' => 'nullable|integer|exists:users,id',
            'labels' => 'nullable|array',
            'labels.*' => 'integer|exists:labels,id',
        ], ['name.unique' => __('tasks.already-exists')]);

        $task->fill($data);
        $task->save();

        if (!empty($data['labels'])) {
            $timestamps = ['created_at' => now(), 'updated_at' => now()];
            $task->labels()->sync(array_fill_keys($data['labels'], $timestamps));
        }

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
