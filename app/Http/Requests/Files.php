<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Files extends FormRequest
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
        //How validate multiple files?
        return [
            'file' => 'required|max:2048|mimes:doc,docx,pdf,xls,xlsx'
        ];
    }
}
