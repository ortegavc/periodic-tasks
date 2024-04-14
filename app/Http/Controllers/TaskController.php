<?php

namespace App\Http\Controllers;

use App\Enums\TaskPeriod;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending_tasks = Task::where('completed', false)->orderBy('due_date')->get(['id', 'title', 'description', 'due_date']);
        $today = $pending_tasks->where('due_date', now()->format('Y-m-d'));
        $tomorrow = $pending_tasks->where('due_date', now()->addDay()->format('Y-m-d'));
        $nextWeek = $pending_tasks->whereBetween('due_date', [now()->nextWeekday()->subDay(), now()->nextWeekendDay()]);
        $nearFuture = $pending_tasks->whereBetween('due_date', [now()->nextWeekendDay(), now()->nextWeekendDay()->addDays(7)]);
        $farFuture =  $pending_tasks->where('due_date', '>', now()->nextWeekendDay()->addDays(7));
        return view('tasks/index', compact('today', 'tomorrow', 'nextWeek', 'nearFuture', 'farFuture'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periods = TaskPeriod::valueDescription();
        return view('tasks/create', compact('periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, TaskService $service)
    {
        $service->store($request);
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
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
