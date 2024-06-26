<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class TenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:domains',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tenancy_db_name' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'domain' => $this->domain . '.' . config('tenancy.central_domains')[1]
        ]);
    }
}
