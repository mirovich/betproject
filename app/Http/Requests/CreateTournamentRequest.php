<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTournamentRequest extends FormRequest
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
            'name' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'start_date_time' => 'required|date_format:H:i',
            'end_date' => 'required|date_format:Y-m-d',
            'end_date_time' => 'required|date_format:H:i',
            'register_end' => 'required|date_format:Y-m-d',
            'register_end_time' => 'required|date_format:H:i',
            'entrance_fee' => 'required',
            'max_participant' => 'required',
            'ensure_won' => 'required',
            'status' => 'required',
            'logo' => 'required|image',
            'matches' => 'required|json'
        ];
    }
}
