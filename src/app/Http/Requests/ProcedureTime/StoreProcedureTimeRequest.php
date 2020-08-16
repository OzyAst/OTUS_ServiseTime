<?php

namespace App\Http\Requests\ProcedureTime;

use App\Http\Requests\FormRequest;

/**
 * Правила при добавлении расписания процедуры
 * Class StoreProcedureTimeRequest
 * @package App\Http\Requests\ProcedureTime
 */
class StoreProcedureTimeRequest extends FormRequest
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
            'procedure_id' => 'integer',
            'times.*' => [
                "day" => 'required|integer|max:127',
                "start" => 'required|string|max:127',
                "end" => 'required|string|max:127',
                "day_off" => 'required|boolean|min:0|max:1',
            ]
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();

        return $data;
    }
}
