<?php

namespace App\Services;

use App\Helper\PrevSaveFormatterHelper;

class Service
{
    public $_length;
    public $_page;
    public $_offset;
    public $_model = null;

    public function __construct()
    {
        $this->_length = request()->get('length', 6);
        $this->_page = request()->get('page', 1);
        $this->_offset = ($this->_page - 1) * $this->_length;
    }

    /**
     * 一般的数据保存和更新
     *
     * @param $params
     * @param integer $id
     * @return mixed
     */
    public function normalSaveData($params, $id = 0)
    {
        $results = 0;
        if ($this->_model !== null) {
            $methods = get_class_methods($this->_model);
            if(in_array('filterFields',$methods)) {
                $params = $this->_model->filterFields($params, $id);
            };
            if ($id !== 0) {
                $record = $this->_model::find($id);
                if (! empty($record)) {
                    foreach ($params as $k => $v) {
                        $record->{$k} = $v;
                    }
                    $record->save();
                    $results = $record->id;
                }
            } else {
                $results = $this->_model::insertGetId($params);
            }
        }

        return $results;
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
