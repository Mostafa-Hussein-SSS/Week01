<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create($request->all());
        return redirect()->back();
    }

    public function edit(Task $task)
    {
        $tasks = Task::all();
        return view('tasks.index', [
            'tasks' => $tasks,
            'editingTask' => $task
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }


    public function markComplete(Task $task)
    {
        $task->update(['is_completed' => true]);
        return redirect()->back();
    }

    public function markIncomplete(Task $task)
    {
        $task->update(['is_completed' => false]);
        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}

