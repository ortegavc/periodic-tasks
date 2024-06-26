<?php

namespace App\Http\Requests;

use App\Enums\TaskPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'sometimes|required',
            'period' => ['required', Rule::enum(TaskPeriod::class)],
            'due_date' => 'requiredIf:period,once|date',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'required_with:start_date|date',
            'group_id' => 'sometimes|nullable|exists:App\Models\Group,id',
        ];
    }
}
