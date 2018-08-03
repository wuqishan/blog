<?php

namespace App\Services;

use App\Helper\PrevSaveFormatter;

class Service
{
    public $_length;
    public $_offset;
    public $_sort_field;
    public $_sort_type;

    public function __construct()
    {
        $this->_length = request()->get('length', 10);
        $this->_offset = request()->get('start', 0);
        $order = request()->get('order');
        $columns = request()->get('columns');
        if (isset($order[0]['column']) && $columns[$order[0]['column']]['data'] && isset($order[0]['dir'])) {
            $this->_sort_field = $columns[$order[0]['column']]['data'];
            $this->_sort_type = $order[0]['dir'];
        }
    }

    /**
     * 一般的数据保存
     *
     * @param $model
     * @param $save_field
     * @param $params
     * @return mixed
     */
    public function normalSaveData($model, $prev_formatter, $save_field, $params)
    {
        // 先做保存前的处理
        $class = PrevSaveFormatter::class;
        foreach ($prev_formatter as $v) {
            $func = $v['func'];
            $key = $v['key'];
            $params = call_user_func("$class::$func", $params, $key);
        }

        foreach ($save_field as $v) {
            $model->$v = $params[$v];
        }

        return $model;
    }

    public function normalDelete($model, $id)
    {
        return $model->destroy($id);
    }
}
