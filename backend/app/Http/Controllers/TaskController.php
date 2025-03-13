<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Support\Facades\Notification;


class TaskController extends Controller 
{
	// GET /api/tasks?completed=true&search=keyword
	public function index(Request $request) // Dependenci injection
	{
		try {
			$query = Task::query();
			if ($request->has('completed')) {
				$query->where('completed', $request->query('completed'));
				//receita para realizar consultas no banco de dados
			}	//coluna COMPLETED do banco de dados, valor que tem que ter na coluna
			if ($request->has('search')) {
				$search = $request->query('search');
				$query->where('title', 'ILIKE', "%$search%")->orWhere('description', 'ILIKE', "%$search%");
			}
			$tasks = $query->get();
			return response()->json($tasks);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Error retrieving tasks'],500);
		}
	}
	
	// POST /api/tasks
	public function store(Request $request) 
	{
		$validated = $request->validate([
			'title' => 'required|max:255',
			'description' => 'nullable',
			'completed' => 'boolean',
			'project_id' => 'nullable|exists:projects,id'
		]);

		try {
			$task = Task::create($validated);
			//notify all users (for demonstration)
			Notification::send(\App\Models\User::all(), new TaskNotification("New task '{$task->title}' created."));
			return response()->json($task, 201);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Error creating task'], 508);
		}
	}

	public function show($id)
	{
		$task = Task::with(['comments', 'attachments'])->find($id);
		if(!$task) {
			return response()->json(['message' => 'Task not found'], 404);
		}
		return response()->json($task);
	}
	
	// PUT /Api/tasks{id}
	public function update(Request $request, $id)
	{
		$task = Task::find($id);
		if (!$task) {
			return response()->json(['message' => 'Task not found'], 404);
		}
		$validated = $request->validate([
			'title' => 'sometimes|required|max:255',
			'description' => 'nullable',
			'completed' => 'boolean',
			'project_id' => 'nullable|exists:projects,id'
		]);

		try {
			$task->update($validated);
			return response()->json($task);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Error updating task'], 500);
		}
	}


	//DELETE /api/tasks/{id}
	public function destroy($id)
	{
		$task = Task::find($id);
		if (!$task) {
			return response()->json(['message' => 'Task not found'], 404);
		}
		try {
			$task->delete();
			return response()->json(['message' => 'Task deleted successfully']);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Error deleting task'],500);
		}
	}
}







