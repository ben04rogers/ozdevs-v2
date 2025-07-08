<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'staff_name' => 'required|string|max:255',
            'staff_role' => 'required|string|max:255',
            'bio' => 'required|nullable|string',
            'email_notifications' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
