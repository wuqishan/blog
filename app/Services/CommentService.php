<?php

namespace App\Services;

use App\Model\Comment;

class CommentService extends Service
{

    public $_model = null;

    /**
     * 哪些字段需要保存
     *
     * @var array
     */
    public $_save_field = [];

    /**
     * 哪些字段需要更新
     */
    public $_update_field = [
        'show'
    ];

    /**
     * 保存前的处理
     *
     * @var array
     */
    public $_prev_save_formatter = [];

    /**
     * 更新前的处理
     *
     * @var array
     */
    public $_prev_update_formatter = [
        ['key' => 'show', 'func' => 'int']
    ];

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();

        $this->_model = new Comment();
    }

    public function getList()
    {
        $results = [];
        $results['page_number'] = $this->_page_number;
        $results['total'] = $this->_model::count();
        $results['list'] = $this->_model::offset($this->_offset)
            ->limit($this->_length)
            ->get()
            ->toArray();

        return $results;
    }

    public function getDetail($id)
    {
        $results = $this->_model->find($id)->toArray();

        return $results;
    }

    public function changeShow($id, $params)
    {
        $mode = $this->_model->find($id);
        $model = $this->normalSaveData($mode, $this->_prev_update_formatter, $this->_update_field, $params);
        $model->save();

        return $model->id;
    }
}
