<?php

namespace App\Services;

use App\Helper\TreeHelper;
use App\Model\Article;

class ArticleService extends Service
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

        $this->_model = new Article();
    }

    public function getList()
    {
        $list = [];
        $results = [];
        $results['length'] = $this->_length;
        $results['total'] = $this->_model::count();
        $model = $this->_model::offset($this->_offset);
        $model = $this->listWhere($model);
        $model = $model->orderBy('id', 'desc');
        $model = $model->limit($this->_length);
        $model = $model->get();

        if (! empty($model)) {
            $list = $model->toArray();
        }
        $results['list'] = $list;

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

    public function getForm()
    {
        $categoryService = new CategoryService();
        $category = $categoryService->_model::all()->toArray();
        $results['category'] = TreeHelper::unlimitedForLevel($category, '━━━');

        return $results;
    }

    private function listWhere($model)
    {
        $filter = $this->filterSearchParams();
        if (isset($filter['keyword']) && ! empty($filter['keyword'])) {
            $keyword = $filter['keyword'];
            $model = $model->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhere('title', 'like', "%{$keyword}%")
                    ->orWhere('ip', $keyword);
            });
        }
        if (isset($filter['start_time']) && ! empty($filter['start_time'])) {
            $model = $model->where('created_at', '>=', "{$filter['start_time']} 00:00:00");
        }
        if (isset($filter['end_time']) && ! empty($filter['end_time'])) {
            $model = $model->where('created_at', '<=', "{$filter['end_time']} 00:00:00");
        }
        if (isset($filter['show']) && ! empty($filter['show'])) {
            $model = $model->where('show', $filter['show']);
        }

        return $model;
    }

    /**
     * 获取list页面搜索结果的参数过滤
     *
     * @return array
     */
    private function filterSearchParams()
    {
        $params['keyword'] = strip_tags(request()->get('keyword'));
        $params['start_time'] = strip_tags(request()->get('start_time'));
        $params['end_time'] = strip_tags(request()->get('end_time'));
        $params['show'] = intval(request()->get('show'));

        return array_filter($params);
    }
}
