<?php

namespace App\Http\Requests\Apointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreApointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can("store apointment");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "date" => ["required"],"time_start" => ["required"],"time_end" => ["required"],
        ];
    }
}
