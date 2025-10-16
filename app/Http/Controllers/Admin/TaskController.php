<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('admin.tasks.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|unique:tasks',
            'description' => 'required',
            'assignee' => 'required',
            'status' => 'required|in:untrackable,submitted,in-progress,completed',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high',
            'comments' => 'nullable'
        ]);

        Task::create($validated);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        return view('admin.tasks.form', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_id' => 'required|unique:tasks,task_id,' . $task->id,
            'description' => 'required',
            'assignee' => 'required',
            'status' => 'required|in:untrackable,submitted,in-progress,completed',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
            'priority' => 'required|in:low,medium,high',
            'comments' => 'nullable'
        ]);

        $task->update($validated);

        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')
            ->with('success', 'Task deleted successfully');
    }
}
