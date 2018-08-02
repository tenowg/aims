<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmittedItem extends FormRequest
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
            'evep-id' => 'nullable|required_without:raw',
            'hub' => 'required',
            'buy' => 'required',
            'raw' => 'nullable|required_without:evep-id'
        ];
    }

    public function messages() {
        return [
            'evep-id.required_without' => 'An Evepraisal ID is required if no items list is supplied.',
            'hub.required' => 'Please select a trade hub to use for pricing.',
            'buy.required' => 'Please select if you want to use buy or sell values',
            'raw.required_without' => 'If no Evepraisal ID is supplied, you need to supply a list of items to sell'
        ];
    }
}
