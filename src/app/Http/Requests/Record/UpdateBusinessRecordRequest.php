<?php

namespace App\Http\Requests\Record;

use App\Http\Requests\FormRequest;

/**
 * Обновление данных записи админом бизнеса
 */
class UpdateBusinessRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            "procedure_id" => ['required', 'integer'],
            "status" => ['required', 'integer'],
            "price" => ['required', 'numeric'],
            "date_start" => ['required', 'date_format:"Y-m-d H:i:s"'],
            "date_end" => ['required', 'date_format:"Y-m-d H:i:s"'],
        ];
    }
}
