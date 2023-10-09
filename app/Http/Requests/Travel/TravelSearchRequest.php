<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;

class TravelSearchRequest extends FormRequest
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
            'countryId' => 'required|numeric',
            'dateFrom' => 'required|string',
            'dateTo' => 'required|string',
            'durationFrom' => 'required|numeric|min:6|max:14',
            'durationTo' => 'required|numeric|min:6|max:14'
        ];
    }

    public function messages(): array
    {
        return [
            'countryId.required' => 'Privalote pasirinkti kelionės šalį',
            'dateFrom.required' => 'Privalote pasirinkti kelionės datą nuo',
            'dateTo.required' => 'Privalote pasirinkti kelionės datą iki',
            'durationFrom.required' => 'Privalote pasirinkti kelionės trukmę nuo',
            'durationTo.required' => 'Privalote pasirinkti kelionės trukmę iki'
        ];
    }
}
