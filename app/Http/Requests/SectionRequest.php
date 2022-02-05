<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'name_ar' => 'required|unique:grades,name->ar,'.$this->id,
            'name_en' => 'required|unique:grades,name->en,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'name_ar.required' => __('grades_trans.grade_name_ar_required'),
            'name_en.required' => __('grades_trans.grade_name_en_required'),
            'name_ar.unique' => __('grades_trans.grade_name_ar_unique'),
            'name_en.unique' => __('grades_trans.grade_name_en_unique'),
        
        ];
    }
}
