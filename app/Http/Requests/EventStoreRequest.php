<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'datetime', 'after_or_equal:today'],
            'location' => ['required', 'string', 'max:255'],
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
            'title.required' => 'Title is required',
            'title.max' => 'Title should not be greater than 255 characters',
            'title.string' => 'Title should be string',
            'description.string' => 'Description should be a string',
            'description.required' => 'Description is required',
            'date.required' => 'Date is required',
            'date.date' => 'Date should be date',
            'location.required' => 'Location is required',
            'location.string' => 'Location should be string',
            'location.max' => 'Location should not be greater than 255 characters',
        ];
    }
}
