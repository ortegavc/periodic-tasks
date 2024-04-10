<?php

namespace Tests\Feature\Task;

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

    public function test_new_tasks_can_register(): void
    {
        $title = fake()->word();
        $response = $this->post('tasks', [
            'title' => $title,
            'description' => fake()->text(),
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => $title,
        ]);

        $response->assertRedirectToRoute('tasks.index');
    }
}
