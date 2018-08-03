<?php

namespace App\Services;

use App\Helper\PrevSaveFormatterHelper;

class Service
{
    public $_length;
    public $_page;
    public $_offset;
    public $_page_number;

    public function __construct()
    {
        $this->_length = request()->get('length', 10);
        $this->_page_number = request()->get('page_number', 15);
        $this->_page = request()->get('page', 1);
        $this->_offset = ($this->_page - 1) * $this->_length;
    }

    /**
     * 一般的数据保存和更新
     *
     * @param $model
     * @param $prev_formatter
     * @param $process_field
     * @param $params
     * @return mixed
     */
    public function normalSaveData($model, $prev_formatter, $process_field, $params)
    {
        // 先做保存前的处理
        $class = PrevSaveFormatterHelper::class;
        foreach ($prev_formatter as $v) {
            $func = $v['func'];
            $key = $v['key'];
            $params = call_user_func("$class::$func", $params, $key);
        }

        foreach ($process_field as $v) {
            $model->$v = $params[$v];
        }

        return $model;
    }

    /**
     * 按照ID删除
     *
     * @param $model
     * @param $id
     * @return mixed
     */
    public function normalDelete($model, $id)
    {
        return $model->destroy($id);
    }
}
