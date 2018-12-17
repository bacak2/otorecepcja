<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Complex extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apartament_name' => 'required|min:4',
            'apartament_link' => 'required', //|unique:apartament_descriptions,apartament_link',
            'apartament_description_begin' => 'required',
            'apartament_geo_lat' => 'required',
            'apartament_geo_lan' => 'required',
            'apartament_gps' => 'required',
            'apartament_address' => 'required',
            'apartament_address_2' => 'required',
            'final_cleaning_price' => 'required',
            'apartament_living_area' => 'required',
            'apartament_registration_time' => 'required',
            'apartament_checkout_time' => 'required',
        ];
    }

    /**
     * Set errors message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'Pole musi być wypełnione',
            '*.min' => 'Pole musi mieć minimum 4 znaki'
        ];
    }
}
