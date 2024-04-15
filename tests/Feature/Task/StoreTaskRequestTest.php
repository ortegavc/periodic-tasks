<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTaskRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_title_is_required(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('tasks');
        $response->assertSessionHasErrors(['title']);
    }

    public function test_task_dates_must_be_present_and_valid_dates(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('tasks', [
            'title' => fake()->word(),
            'due_date' => '',  // The due date field must have a value when present.
            'start_date' => '2024',  // The start date field must be a valid date.
            // 'end_date' => '',  // The end date field is required when start date is present. (do not uncomment)
        ]);

        // $response->ddSession();  // helpfull to debug form request validation responses

        $response->assertSessionHasErrors(['due_date', 'start_date', 'end_date']);
    }
}