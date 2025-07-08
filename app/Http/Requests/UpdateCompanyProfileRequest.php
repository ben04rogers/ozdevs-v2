<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => 'sometimes|string|max:255',
            'website' => 'sometimes|nullable|max:255',
            'staff_name' => 'sometimes|string|max:255',
            'staff_role' => 'sometimes|string|max:255',
            'bio' => 'sometimes|nullable|string|max:1000',
            'email_notifications' => 'sometimes|nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
