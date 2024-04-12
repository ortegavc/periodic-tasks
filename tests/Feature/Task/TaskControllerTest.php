<?php

namespace Tests\Feature\Task;

use Carbon\CarbonPeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_tasks_index_can_be_rendered(): void
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    public function test_create_task_once(): void
    {
        $title = fake()->word();
        $response = $this->post('tasks', [
            'title' => $title,
            'description' => fake()->text(),
            'due_date' => now(),
            'period' => 'once',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => $title,
        ]);

        $response->assertRedirectToRoute('tasks.index');
    }

    public function test_create_tasks_every_day(): void
    {
        $title = fake()->word();
        $startDate = now();
        $endDatte = now()->addDays(7);

        $this->post('tasks', [
            'title' => $title,
            'description' => fake()->text(),
            'period' => 'daily',
            'start_date' => $startDate,
            'end_date' => $endDatte,
        ]);

        $this->assertDatabaseCount('tasks', 8);
    }

    public function test_create_tasks_every_monday(): void
    {
        $startDate = now();
        $endDatte = now()->addMonth();

        $this->post('tasks', [
            'title' => fake()->word(),
            'description' => fake()->text(),
            'period' => 'monday',
            'start_date' => $startDate,
            'end_date' => $endDatte,
        ]);

        $period = CarbonPeriod::between($startDate, $endDatte)
            ->filter(fn($date) => $date->isMonday());

        foreach ($period as $date) {
            $this->assertDatabaseHas('tasks', [
                'due_date' => $date->format('Y-m-d'),
            ]);
        }

    }
}
