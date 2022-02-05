<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'List_Classes.*.name_ar' => 'required',
            'List_Classes.*.name_en' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'List_Classes.*.name_ar.required' => __('classes_trans.class_name_ar_required'),
            'List_Classes.*.name_en.required' => __('classes_trans.class_name_en_required'),
            'name_ar.unique' => __('classes_trans.class_name_ar_unique'),
            'name_en.unique' => __('classes_trans.class_name_en_unique'),
            
            // 'name.required' => trans('validation.required'),

        ];
    }
}
