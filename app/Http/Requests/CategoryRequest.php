<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CategoryRequest extends FormRequest
{
    public $rules = [
        'category.store' => [
            'title' => 'required',
            'order' => 'required|integer',
            'parent_id' => 'required|integer',
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
            'title.required' => '分类名称必须填写',
            'order.required' => '排序参数必须填写',
            'order.integer' => '排序参数必须为整数',
            'parent_id.required' => '父级分类必须选择',
            'parent_id.integer' => '父级分类必须为整数',
        ];
    }
}
