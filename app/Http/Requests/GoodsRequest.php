<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class GoodsRequest extends FormRequest
{
    public $rules = [
        'admin::goods.store' => [
            'title' => 'required',
            'unit' => 'required',
            'image_id' => 'required',
        ],
        'admin::goods.update' => [
            'title' => 'required',
            'unit' => 'required',
            'image_id' => 'required'
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
            'title.required' => '商品名称必须填写',
            'unit.required' => '商品单位必须填写',
            'images.required' => '商品图片必须上传'
        ];
    }
}
