<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ActivityFilterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'activity_type' => ['sometimes', 'string'],
            'session_type' => ['sometimes', 'string'],
            'city' => ['sometimes', 'string'],
            'start_date' => ['sometimes', 'date', 'date_format:Y-m-d'],
        ];
    }
}
