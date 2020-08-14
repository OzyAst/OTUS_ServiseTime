<?php

namespace App\Http\Requests\BusinessAddress;

use App\Http\Requests\FormRequest;

/**
 * Правила при добавлении процедуры
 * Class StoreProcedureRequest
 * @package App\Http\Requests\Procedure
 */
class StoreBusinessAddressRequest extends FormRequest
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
            "address" => 'required|string',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();

        return $data;
    }
}
