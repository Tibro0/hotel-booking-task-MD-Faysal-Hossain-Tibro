<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^01[3-9]\d{8}$/',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'room_category_id' => 'required|exists:room_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Please provide a valid Bangladeshi phone number (e.g., 01712345678)',
            'check_in.after_or_equal' => 'Check-in date cannot be in the past',
            'check_out.after' => 'Check-out date must be after check-in date',
        ];
    }
}
