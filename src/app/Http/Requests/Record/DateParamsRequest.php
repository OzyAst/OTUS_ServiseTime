<?php

namespace App\Http\Requests\Record;

use App\Http\Requests\FormRequest;

/**
 * Даты переданные при запросе записей
 */
class DateParamsRequest extends FormRequest
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
            "date_start" => ['date_format:"d.m.Y"', 'nullable'],
            "date_end" => ['date_format:"d.m.Y"', 'nullable'],
        ];
    }
}
