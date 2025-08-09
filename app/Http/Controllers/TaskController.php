<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Task::create([
            'title' => $request->title,
            'is_done' => $request->has('is_done') ? 1 : 0, // default unchecked
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $task->update([
            'title' => $request->title,
            'is_done' => $request->has('is_done') ? 1 : 0,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    
public function toggleCompleted(Task $task)
{
    
    $task->is_done = !$task->is_done;
    $task->save();

    return redirect()->back();
}

}
