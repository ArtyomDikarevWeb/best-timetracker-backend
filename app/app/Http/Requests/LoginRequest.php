<?php

namespace App\Http\Requests;

use App\Data\LoginData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required_without:username', 'email', 'string', 'min:8', 'max:255'],
            'username' => ['required_without:email', 'string', 'min:8', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];
    }

    public function dto(): LoginData
    {
        return LoginData::from($this->validated());
    }
}
