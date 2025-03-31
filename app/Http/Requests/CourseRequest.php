<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            "title" => ["required", "min:3", "max:255"],
            "description" => ["required", "min:3", "max:255"],
            "thumbnail" => ["required"],
            "badge" => ["required", "in:Beginner,Intermediate,Advanced"], 
            "overview" => ["required"],
            "time_to_complete" => ["required"],
            "price" => ["required"],
            "subscription_type" => ["required", "in:Free,Paid"], 
        ];
    }
}
