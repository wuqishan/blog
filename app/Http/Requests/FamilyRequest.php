<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class FamilyRequest extends FormRequest
{
    public $rules = [
        'family.store' => [
            'name' => 'required',
            'title' => 'required',
            'temp_files' => 'required',
            'age' => 'required|integer|min:0|max:128'
        ]
    ];

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
        $route = Route::currentRouteName();
        $rules = [];
        if (isset($this->rules[$route])) {
            $rules = $this->rules[$route];
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名称必须填写',
            'title.required' => '称谓必须填写',
            'temp_files.required' => '照片必须上传',
            'age.required' => '年龄必须填写范围：0~128',
            'age.min' => '年龄必须填写范围：0~128',
            'age.integer' => '年龄必须填写范围：0~128',
            'age.max' => '年龄必须填写范围：0~128'
        ];
    }
}
