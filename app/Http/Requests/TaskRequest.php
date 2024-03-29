<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'          => ['required', 'string', 'min:1', 'max:255'],
            'description'    => ['required', 'string', 'min:1'],
            'assigned_by_id' => ['required', 'numeric', Rule::exists('users', 'id')->where('role', Role::ADMIN->value)],
            'assigned_to_id' => ['required', 'numeric', Rule::exists('users', 'id')->where('role', Role::USER->value)],
        ];
    }
}
