<?php

namespace App\Http\Requests\Feedback;

use App\Http\Requests\FormRequest;

/**
 * Правила при добавлении обратной связи
 * Class StoreProcedureRequest
 * @package App\Http\Requests\Procedure
 */
class StoreFeedbackRequest extends FormRequest
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
            "email" => 'required|email|max:255',
            "business_id" => 'required|integer',
            "name" => 'required|string|max:255',
            "text" => 'required|string',
        ];
    }

    public function getFormData()
    {
        $data = parent::getFromData();
        return $data;
    }
}
