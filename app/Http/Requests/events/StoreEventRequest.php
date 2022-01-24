<?php

namespace App\Http\Requests\events;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'start-date' => 'required',
            'end-date' => 'required',
            'event-category' => 'required',
            'event-type' => 'required',
            'event-link' => 'required',
            'description' => 'required',
            'file' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            //
        ];
    }
}
