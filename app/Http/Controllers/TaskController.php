<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function index(Request $request)
  {
    $query = Task::where('user_id', Auth::id());

    // Filter status
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    // Sorting deadline
    $sortOrder = $request->get('sort', 'asc'); // default asc
    $query->orderBy('deadline', $sortOrder);

    $tasks = $query->get();

    return view('tasks.index', [
      'title' => 'Tasks',
      'active' => 'tasks',
      'tasks' => $tasks
    ]);
  }


  public function create()
  {
    return view('tasks.create', [
      'title' => 'Create Task',
      'active' => 'tasks'
    ]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'status' => 'required|in:To Do,In Progress,Done',
      'deadline' => 'required|date'
    ]);

    $validated['user_id'] = Auth::id();
    $validated['created_by'] = Auth::user()->name;

    Task::create($validated);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
  }

  public function edit(Task $task)
  {
    $this->authorizeUser($task);
    return view('tasks.edit', [
      'title' => 'Edit Task',
      'active' => 'tasks',
      'task' => $task
    ]);
  }

  public function update(Request $request, Task $task)
  {
    $this->authorizeUser($task);

    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'status' => 'required|in:To Do,In Progress,Done',
      'deadline' => 'required|date'
    ]);

    $task->update($validated);

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
  }

  public function destroy(Task $task)
  {
    $this->authorizeUser($task);
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
  }

  private function authorizeUser(Task $task)
  {
    if ($task->user_id !== Auth::id()) {
      abort(403, 'Unauthorized action.');
    }
  }
}
