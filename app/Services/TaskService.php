<?php

namespace App\Services;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Carbon\CarbonPeriod;

class TaskService
{
    public function store(StoreTaskRequest $request): void
    {
        $period = $request->safe()['period'];
        if (in_array($period, ['daily', 'monday', 'wednesday', 'friday'])) {
            $this->createDaily($request->safe()->only(['start_date', 'end_date', 'title', 'description', 'period']));
        } elseif($period == 'once') {
            Task::create($request->safe()->only(['title', 'description', 'due_date']));
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

        $tasks = [];
        foreach ($series as $date) {
            $tasks[] = ['title' => $validated['title'], 'description' => $validated['description'], 'due_date' => $date, 'created_at' => now(), 'updated_at' => now()];
        }

        return Task::insert($tasks);
    }

}