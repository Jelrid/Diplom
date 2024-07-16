<?php

namespace App\Http\Requests;

use App\Models\Pacient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'fathers_name' => ['required', 'string', 'max:255'],
            'birthdate' => ['string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'mobile_phone' => [ 'max:255'],
            'email' => ['email','max:255'],
        ];
    }
}
