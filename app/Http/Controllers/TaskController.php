<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class TaskController
{

    public function index()
    {
        return response()->json(Task::all(), 200);
    }


    public function show(Task $task)
    {
        Gate::authorize('modify', $task);
        return response()->json($task, 200);
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|date',
            'is_completed' => 'required|boolean',
            'has_reminder' => 'required|boolean',
        ]);

        $task = $request->user()->tasks()->create($fields);

        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('modify', $task);


        $fields = $request->validate([
            'name' => 'nullable|string|max:255',
            'time' => 'nullable|date',
            'is_completed' => 'nullable|boolean',
            'has_reminder' => 'nullable|boolean',
        ]);

        $task->update($fields);

        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        Gate::authorize('modify', $task);

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

    public function getTasksByUser()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $tasks = Task::where("user_id", Auth::id())->get();
    
        if ($tasks->isEmpty()) {
            return response()->json([], 200);
        }
    
        return response()->json($tasks, 200);
    }
}
