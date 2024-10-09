<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profilesRequest extends FormRequest
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
            'user_id' => [
                    'max:20'
                ],
            'first_name' => [
                    'required',
                    'max:255'
                ],
                'surname' => [
                    'required',
                    'max:255'
                ],
                'gender' => [
                    'required',
                    'max:255'
                ],
                'nin' => [
                    'required',
                    'max:255'
                ],
                'address' => [
                    'required',
                    'max:255'
                ],
                'phone' => [
                    'required',
                    'max:255'
                ],
                'email' => [
                    'max:255'
                ],
                'photo' => [
                    'max:5000'
                ],
                'nin_slip' => [
                    'max:5000'
                ],
        ];
    }
}
