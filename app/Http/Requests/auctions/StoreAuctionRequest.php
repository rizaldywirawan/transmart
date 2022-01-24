<?php

namespace App\Http\Requests\auctions;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionRequest extends FormRequest
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
            'event-id' => 'required',
            'name' => 'required',
            'start-date' => 'required',
            'end-date' => 'required',
            'starting-bid' => 'required',
            'bid-increment' => 'required',
            'description' => 'required',
            'files' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'event-id' => 'event',
            'name' => 'name',
            'start-date' => 'start date',
            'end-date' => 'end date',
            'starting-bid' => 'starting bid',
            'bid-increment' => 'bid increment',
            'description' => 'description',
            'files' => 'item photos',
        ];
    }
}
