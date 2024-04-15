<?php

namespace App\Http\Controllers;

use App\Enums\TaskPeriod;
use App\Http\Requests\{StoreTaskRequest, UpdateTaskRequest};
use App\Models\{Group, Task};
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get pending tasks and needed fields only
        $pending_tasks = Task::where('completed', false)->orderBy('due_date')->get(['id', 'title', 'description', 'due_date']);
        // All dates in laravel are parsed to Carbon objects
        $overdue = $pending_tasks->where('due_date', '<', now()->format('Y-m-d'));
        $today = $pending_tasks->where('due_date', now()->format('Y-m-d'));
        $tomorrow = $pending_tasks->where('due_date', now()->addDay()->format('Y-m-d'));
        $nextWeek = $pending_tasks->whereBetween('due_date', [now()->nextWeekday()->subDay(), now()->nextWeekendDay()]);
        $nearFuture = $pending_tasks->whereBetween('due_date', [now()->nextWeekendDay(), now()->nextWeekendDay()->addDays(7)]);
        $farFuture = $pending_tasks->where('due_date', '>', now()->nextWeekendDay()->addDays(7));
        return view('tasks/index', compact('overdue', 'today', 'tomorrow', 'nextWeek', 'nearFuture', 'farFuture'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periods = TaskPeriod::valueDescription();
        $groups = Group::all();
        return view('tasks/create', compact('groups', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, TaskService $service)
    {
        $service->store($request, Auth::id());
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, TaskService $service)
    {
        $service->update($request, $task);
        $task->fresh();
        return response()->json($task, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
