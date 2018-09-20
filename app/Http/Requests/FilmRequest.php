<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'release_date' => 'required|date',
            'rating' => 'required|integer|between:1,5',
            'ticket_price' => 'required|regex:/^\d*(\.\d{1,2})?$/',// with 2 decimal point
            'country_id' => 'required|not_in:0',
            'photo' => 'required',
        ];
    }
}
