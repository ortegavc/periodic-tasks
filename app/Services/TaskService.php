<?php

namespace App\Services;

use App\Http\Requests\{StoreTaskRequest, UpdateTaskRequest};
use App\Models\Task;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TaskService
{
    public function store(StoreTaskRequest $request): void
    {
        $period = $request->safe()['period'];
        if (in_array($period, ['daily', 'monday', 'wednesday', 'friday'])) {
            $this->createDaily($request->validated());
        } elseif ($period == 'monthly') {
            $this->createMonthly($request->validated());
        } elseif ($period == 'once') {
            Task::create($request->safe()->only(['title', 'description', 'due_date', 'group_id']));
        }
    }

    public function update(UpdateTaskRequest $request, Task $task): void
    {
        if($request->has('completed')) {
            $task->completed = true;
            $task->save();
        }
    }

    private function createDaily(array $validated): bool
    {
        $series = CarbonPeriod::between($validated['start_date'], $validated['end_date']);

        switch ($validated['period']) {
            case 'monday':
                $series->filter(fn($date) => $date->isMonday());
                break;
            case 'wednesday':
                $series->filter(fn($date) => $date->isWednesday());
                break;
            case 'friday':
                $series->filter(fn($date) => $date->isFriday());
                break;
        }

        return Task::insert($this->getTasksArray($series, $validated));
    }

    private function createMonthly(array $validated): bool
    {
        $startDate = Carbon::parse($validated['start_date']);
        $startDate->day(5); // this one do the magic in order to calc the 5th of each month
        $series = CarbonPeriod::create($startDate, '1 month', $validated['end_date'])->filter(fn($date) => $date->isFuture());
        return Task::insert($this->getTasksArray($series, $validated));
    }

    private function getTasksArray($series, $validated): array
    {
        $tasks = [];
        foreach ($series as $date) {
            $tasks[] = [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'due_date' => $date,
                'group_id' => $validated['group_id'],
                'created_at' => now(),
                'updated_at' => now(),  // it's neccessary set timestamps values manually since query builder 'insert' left them as null.
            ];
        }
        return $tasks;
    }

}