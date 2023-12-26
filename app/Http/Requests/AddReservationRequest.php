<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddReservationRequest extends FormRequest
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
            'adminId' => 'required',
            'userId' => 'required',
            'date' => 'required',
            'time' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'adminId.required' => 'не передали админа',
            'userId.required' => 'не передали пользователя',
            'date.required' => 'не передали дату',
            'time.required' => 'не передали время',
        ];
    }
}
