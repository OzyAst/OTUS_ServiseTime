<?php

namespace App\Http\Requests\BusinessContact;

use App\Http\Requests\FormRequest;

/**
 * Правила при добавлении записи
 * Class StoreProcedureRequest
 * @package App\Http\Requests\Procedure
 */
class StoreBusinessContactRequest extends FormRequest
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
            "contact" => 'required|string',
            "business_address_id" => 'required|int',
            "type_id" => 'required|int',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();

        return $data;
    }
}
