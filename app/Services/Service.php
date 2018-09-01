<?php

namespace App\Services;

class Service
{
    public $_length;            // 每页显示条数
    public $_page;              // 当前第几页
    public $_offset;            // 获取数据的偏移量
    public $_model = null;      // 当前处理的模型

    public function __construct()
    {
        $this->_length = request()->get('length', 6);
        $this->_page = request()->get('page', 1);
        $this->_offset = ($this->_page - 1) * $this->_length;
    }

    /**
     * 获取list数据
     *
     * @return mixed
     */
    public function getList()
    {
        $results['length'] = $this->_length;
        $results['list'] = [];

        $this->_model = $this->listWhere($this->_model);
        $results['total'] = $this->_model->count('id');  // 在分页查询前获取总数量
        $this->_model->offset($this->_offset)->limit($this->_length);
        $dataModel = $this->_model->get();

        if (! empty($dataModel)) {
            $results['list'] = $dataModel->toArray();
        }

        return $results;
    }

    /**
     * 一般获取详细页方法
     *
     * @param $id
     * @return array
     */
    public function getDetail($id)
    {
        $results = [];
        $dataModel = $this->_model->find($id);
        if (! empty($dataModel)) {
            $results = $dataModel->toArray();
        }

        return $results;
    }

    /**
     * 一般的数据保存和更新
     *
     * @param $params
     * @param integer $id
     * @return mixed
     */
    public function saveData($params, $id = 0)
    {
        $results = 0;
        if ($this->_model !== null) {
            $methods = get_class_methods($this->_model);
            if(in_array('filterFields',$methods)) {
                $params = $this->_model->filterFields($params, $id);
            };
            if ($id !== 0) {
                $record = $this->_model->find($id);
                if (! empty($record)) {
                    foreach ($params as $k => $v) {
                        $record->{$k} = $v;
                    }
                    $record->save();
                    $results = $record->id;
                }
            } else {
                $results = $this->_model->insertGetId($params);
            }
        }

        return $results;
    }

    /**
     * 按照ID删除，$flag=true表示从数据库删除，否则改变delete值为2
     *
     * @param $id
     * @param bool $flag
     * @return bool
     */
    public function delete($id, $flag)
    {
        $results = false;
        if ($flag) {
            $results = (bool) $this->_model->destroy($id);
        } else {
            $results = (bool) $this->_model->where('id', $id)->update(['deleted' => 2]);
        }

        return $results;
    }
}
