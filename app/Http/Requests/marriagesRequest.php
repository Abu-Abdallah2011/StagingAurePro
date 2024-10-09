<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class marriagesRequest extends FormRequest
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
            'husband_id' => [
                    'exists:profiles,id',
                    'max:255'
                ],
                'wife_id' => [
                    'exists:profiles,id',
                    'max:255'
                ],
                'date' => [
                    'required',
                    'max:255'
                ],
                'time' => [
                    'required',
                    'max:255'
                ],
                'venue' => [
                    'required',
                    'max:255'
                ],
                'dowry' => [
                    'required',
                    'max:255'
                ],
                'dowry_status' => [
                    'required',
                    'max:255'
                ],
                'husband_test' => [
                    'max:5000'
                ],
                'wife_test' => [
                    'max:5000'
                ],
                'waliyy_id' => [
                    'max:255',
                    'required',
                    'exists:profiles,id'
                ],
                'wakil_id' => [
                    'max:255',
                    'required',
                    'exists:profiles,id'
                ],
                'venue_id' => [
                    'required',
                    'exists:masajid,id'
                ],
                'status' => [
                    'max:255',
                ],
                'approved_by' => [
                    'max:20',
                ],
                'activated_by' => [
                    'max:20',
                ],
                'activation_date' => [
                    'max:255',
                ],
                'deactivated_by' => [
                    'max:20',
                ],
                'deactivation_date' => [
                    'max:255',
                ],
        ];
    }
}
