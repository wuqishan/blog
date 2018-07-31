<?php

namespace App\Services;

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
     *
     * CategoryService constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_model = new Category();
    }

    public function saveData($params)
    {
        $this->model = $this->normalSaveData($this->_model, $this->_prev_save_formatter, $this->_save_field, $params);
        $this->model->save();

        return $this->model->id;
    }
}
