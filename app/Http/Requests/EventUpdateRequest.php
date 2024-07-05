<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'date' => ['nullable', 'date', 'after_or_equal:today'],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'title.max' => 'Title should not be greater than 255 characters',
            'title.string' => 'Title should be string',
            'description.string' => 'Description should be a string',
            'date.required' => 'Date is required',
            'date.date' => 'Date should be date',
            'location.string' => 'Location should be string',
            'location.max' => 'Location should not be greater than 255 characters',
        ];
    }


}
