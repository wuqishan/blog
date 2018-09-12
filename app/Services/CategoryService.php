<?php

namespace App\Services;

use App\Helper\TreeHelper;
use App\Model\Category;

class CategoryService extends Service
{
    public $_model = null;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();

        $this->_model = new Category();
    }

    public function getList()
    {
        $results['list'] = [];
        $list = $this->listWhere()->get();
        if (! empty($list)) {
            $results['list'] = $list->toArray();
        }
        $results['list'] = TreeHelper::unlimitedForLevel($results['list'], '━━━');

        return $results;
    }

    /**
     * @param $params
     * @param int $id
     * @return mixed
     */
    public function saveData($params, $id = 0)
    {
        $id = intval($id);
        if ($id > 0) {
            $detail = $this->_model->find($id);
            if (! empty($detail)) {
                $detail->title = strip_tags($params['title']);
                $detail->description = strip_tags($params['description']);
                $detail->order = intval($params['order']);
                $detail->level = intval($params['level']);
                $detail->save();
            }
        } else {
            $data = [
                'parent_id' => intval($params['parent_id']),
                'title' => strip_tags($params['title']),
                'description' => strip_tags($params['description']),
                'order' => intval($params['order']),
                'level' => intval($params['level']),
            ];
            $id = $this->_model->insertGetId($data);
        }

        return $id;
    }

    public function getDetail($id)
    {
        $results = [];
        $dataModel = $this->_model->find($id);
        if (! empty($dataModel)) {
            $results = $dataModel->toArray();
        }

        return $results;
    }

    public function delete($id)
    {
        $results = false;
        if ($this->_checkDelete($id)) {
            $results = (bool) $this->_model->destroy($id);
        }

        return $results;
    }

    public function getForm()
    {
        $category = $this->_model->whereIn('level', [1, 2])->get()->toArray();
        $results['parent'] = TreeHelper::unlimitedForLevel($category, '━━━');

        return $results;
    }

    /**
     * 检查当前分类是否可以删除，没有子分类才能删除
     *
     * @param $id
     * @return bool
     */
    private function _checkDelete($id)
    {
        return ! (bool) $this->_model->where('parent_id', $id)->first();
    }

    /**
     * 获取搜索条件
     *
     * @return Category|null
     */
    public function listWhere()
    {
        $filter = $this->filterSearchParams();

        // 处理排序
        if (
            isset($filter['sort_field']) && ! empty($filter['sort_field']) &&
            isset($filter['sort_type']) && ! empty($filter['sort_type'])
        ) {
            $this->_model = $this->_model->orderBy($filter['sort_field'], $filter['sort_type']);
        }

        return $this->_model;
    }

    /**
     * 获取list页面搜索结果的参数过滤
     *
     * @return array
     */
    public function filterSearchParams()
    {
        $params['sort_field'] = strip_tags(request()->get('sort_field', 'id'));
        $params['sort_type'] = strip_tags(request()->get('sort_type', 'desc'));

        return array_filter($params);
    }
}
