<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeveloperProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'hero' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|in:Australian Capital Territory,New South Wales,Northern Territory,Queensland,South Australia,Tasmania,Victoria,Western Australia',
            'country' => 'required|in:Australia',
            'bio' => 'required|nullable|string',
            'search_status' => ['nullable', Rule::in(['actively looking', 'open', 'not interested', 'invisible'])],
            'role_level' => ['nullable', Rule::in(['junior', 'mid', 'senior', 'principal'])],
            'part_time' => 'nullable|boolean',
            'full_time' => 'nullable|boolean',
            'contract' => 'nullable|boolean',
            'website' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'stack_overflow' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'email_notifications' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
