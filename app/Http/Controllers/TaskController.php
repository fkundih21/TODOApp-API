<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController
{

    public function index()
    {
        return response()->json(Task::all(), 200);
    }

    public function store(Request $request)
    {
        echo($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|date',
            'is_completed' => 'required|boolean',
            'has_reminder' => 'required|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task = Task::create([
            'name' => $request->name,
            'time' => $request->time,
            'is_completed' => $request->is_completed,
            'has_reminder' => $request->has_reminder,
            'user_id' => $request->user_id,
        ]);

        return response()->json($task, 201);
    }

    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task, 200);
    }

    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'time' => 'nullable|date',
            'is_completed' => 'nullable|boolean',
            'has_reminder' => 'nullable|boolean',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update([
            'name' => $request->name ?? $task->name,
            'time' => $request->time ?? $task->time,
            'is_completed' => $request->is_completed ?? $task->is_completed,
            'has_reminder' => $request->has_reminder ?? $task->has_reminder,
            'user_id' => $request->user_id ?? $task->user_id,
        ]);

        return response()->json($task, 200);
    }

    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

    public function getTasksByUser($userId)
    {
        $tasks = Task::where("user_id", $userId)->get();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'This user has no tasks'], 404);
        }

        return response()->json($tasks, 200);
    }
}
