<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'date' => 'required|date_format:Y-m-d',
            'code' => 'required|string|max:10',
        ];
    }
}
