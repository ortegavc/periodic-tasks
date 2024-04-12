<?php

namespace App\Services;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Carbon\CarbonPeriod;

class TaskService
{
    public function store(StoreTaskRequest $request): void
    {
        switch ($request->safe()['period']) {
            case 'daily':
                $this->createDaily($request->safe()->only(['start_date', 'end_date', 'title', 'description', 'period']));
                break;

            case 'once':
                Task::create($request->safe()->only(['title', 'description', 'due_date']));
                break;
        }
    }

    private function createDaily(array $validated): bool
    {
        $series = CarbonPeriod::between($validated['start_date'], $validated['end_date']);
        $tasks = [];
        foreach ($series as $date) {
            $tasks[] = ['title' => $validated['title'], 'description' => $validated['description'], 'due_date' => $date, 'created_at' => now(), 'updated_at' => now()];
        }
        return Task::insert($tasks);
    }

}