<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeveloperProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'hero' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => [
                'sometimes',
                'string',
                Rule::in([
                    'Australian Capital Territory',
                    'New South Wales',
                    'Northern Territory',
                    'Queensland',
                    'South Australia',
                    'Tasmania',
                    'Victoria',
                    'Western Australia',
                ]),
            ],
            'country' => ['sometimes', Rule::in(['Australia'])],
            'bio' => 'sometimes|nullable|string',
            'search_status' => ['sometimes', Rule::in(['actively looking', 'open', 'not interested', 'invisible'])],
            'role_level' => ['sometimes', Rule::in(['junior', 'mid', 'senior', 'principal'])],
            'part_time' => 'sometimes|boolean',
            'full_time' => 'sometimes|boolean',
            'contract' => 'sometimes|boolean',
            'website' => 'sometimes|nullable|string|max:255',
            'github' => 'sometimes|nullable|string|max:255',
            'twitter' => 'sometimes|nullable|string|max:255',
            'stack_overflow' => 'sometimes|nullable|string|max:255',
            'linkedin' => 'sometimes|nullable|string|max:255',
            'email_notifications' => 'sometimes|boolean',
            'image' => 'sometimes|image|max:2048',
        ];
    }
}
