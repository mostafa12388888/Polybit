<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\PhoneNumber;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()?->id)],
            'phone' => ['nullable', 'phone', Rule::unique(User::class)->ignore($this->user()?->id)],
        ];
    }

    public function prepareForValidation()
    {
        if ($this->phone) {
            try {
                $this->merge([
                    'phone' => (new PhoneNumber($this->phone, ['EG']))->formatE164(),
                ]);
            } catch (\Throwable $th) {
                $this->merge(['phone' => 'notvalid']);
            }
        }
    }
}
