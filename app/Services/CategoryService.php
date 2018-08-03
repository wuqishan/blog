<?php

namespace App\Services;

use App\Helper\TreeHelper;
use App\Model\Category;
use App\Model\Family;
use App\Model\TempFiles;

class CategoryService extends Service
{

    public $_model = null;

    /**
     * 哪些字段需要保存
     *
     * @var array
     */
    public $_save_field = [
        'title', 'parent_id', 'order', 'level', 'description'
    ];

    /**
     * 保存前的处理
     *
     * @var array
     */
    public $_prev_save_formatter = [
        ['key' => 'title', 'func' => 'stripTags'],
        ['key' => 'parent_id', 'func' => 'int'],
        ['key' => 'order', 'func' => 'int'],
        ['key' => 'level', 'func' => 'int'],
        ['key' => 'description', 'func' => 'stripTags'],
    ];

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
        $category = $this->_model::orderBy('order', 'asc')->get()->toArray();
        $results['data'] = TreeHelper::unlimitedForLevel($category, '━━━');

        return $results;
    }

    public function saveData($params)
    {
        $this->model = $this->normalSaveData($this->_model, $this->_prev_save_formatter, $this->_save_field, $params);
        $this->model->save();

        return $this->model->id;
    }

    public function delete($id)
    {
        $results = false;
        if ($this->_checkDelete($id)) {
            $results = (bool) $this->normalDelete($this->_model, $id);
        }

        return $results;
    }

    public function getForm()
    {
        $category = $this->_model::whereIn('level', [1, 2])->get()->toArray();
        $results['data'] = TreeHelper::unlimitedForLevel($category, '━━━');

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
}
