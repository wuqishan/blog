<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class GoodsExportRequest extends FormRequest
{
    public $rules = [
        'admin::goods_export.store' => [
            'goods_id' => 'required',
            'number' => 'required',
            'image_id' => 'required',
        ],
        'admin::goods_export.update' => [
            'goods_id' => 'required',
            'number' => 'required',
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
            'goods_id.required' => '商品必须选择',
            'number.required' => '商品导入数量必须填写',
            'image_id.required' => '商品导入凭据必须上传'
        ];
    }
}
