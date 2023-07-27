<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'staff_name' => 'required|string|max:255',
            'staff_role' => 'required|string|max:255',
            'bio' => 'required|nullable|string',
            'email_notifications' => 'nullable|boolean',
        ];
    }
}
