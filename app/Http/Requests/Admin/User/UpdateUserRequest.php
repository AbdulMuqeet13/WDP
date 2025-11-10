<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'wallet_address' => 'nullable|string|max:255',
            'is_active' => 'required',
            'referral_code' => [
                'required',
                'max:8',
                Rule::unique('users', 'referral_code')->ignore($this->id, 'id'),
            ],
            'created_at' => 'required',
        ];
    }
}
