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
        return auth()->user()->can("insert apointment");;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "date" => ["required"], "time_start" => ["required"], "type" => ["required"],"user_id" => ["nullable"], "service_id" => ["nullable"], "pet_id"=>["required"]
        ];
    }
}
