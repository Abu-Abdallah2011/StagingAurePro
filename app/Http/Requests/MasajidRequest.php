<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasajidRequest extends FormRequest
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
            'name' => [
                    'required',
                    'max:255'
                ],
                'address' => [
                    'required',
                    'max:255'
                ],
                'cac_reg' => [
                    'max:255'
                ],
                'email' => [
                    'email',
                    'max:255'
                ],
                'acct_name' => [
                    'required',
                    'max:255'
                ],
                'acct_no' => [
                    'required',
                    'max:255'
                ],
                'bank' => [
                    'required',
                    'max:255'
                ],
                'imam_id' => [
                    'required',
                    'max:255'
                ],
                'muazzin_id' => [
                    'required',
                    'max:255'
                ],
                'chairman_id' => [
                    'required',
                    'max:255'
                ],
                
        ];
    }
}
