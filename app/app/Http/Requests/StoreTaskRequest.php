<?php

namespace App\Http\Requests;

use App\Data\TaskData;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'is_completed' => ['required', 'boolean'],
            'finished_at' => ['nullable', 'date_format:Y-m-d H:i:s']
        ];
    }

    public function dto(): TaskData
    {
        return TaskData::from($this->validated());
    }
}
