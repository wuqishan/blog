<?php

namespace App\Services;

use App\Model\Goods;

class GoodsService extends Service
{

    public $_model = null;
    private $_results = [];

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_model = new Goods();
    }

    /**
     * list 显示
     *
     * @return array
     */
    public function getList()
    {
        $this->_results['length'] = $this->_length;
        $this->_results['list'] = [];

        $this->_model = $this->listWhere($this->_model)
                    ->offset($this->_offset)
                    ->orderBy('id', 'desc')
                    ->limit($this->_length);

        $dataModel = $this->_model->get();
        $this->_results['total'] = $this->_model->count();

        if (! empty($dataModel)) {
            $this->_results['list'] = $dataModel->toArray();
        }

        return $this->_results;
    }

    public function getDetail($id)
    {
        $results = $this->_model->find($id)->toArray();

        return $results;
    }


    public function getForm()
    {
        $categoryService = new CategoryService();
        $category = $categoryService->_model::all()->toArray();
        $results['category'] = TreeHelper::unlimitedForLevel($category, '━━━');

        return $results;
    }

    public function normalSaveData($params, $id = 0)
    {
        $imageUrl = [];
        if (isset($params['images'])) {
            $tempFilesService = new TempFilesService();
            $imageUrl = $tempFilesService->getUrl($params['images']);
        }
        $params['images'] = implode(',', $imageUrl);

        return parent::normalSaveData($params, $id);
    }

    private function listWhere()
    {
        $filter = $this->filterSearchParams();
        if (isset($filter['keyword']) && ! empty($filter['keyword'])) {
            $keyword = $filter['keyword'];
            $this->_model = $this->_model->where(function ($query) use ($keyword) {
                $query->orWhere('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }
        if (isset($filter['status']) && ! empty($filter['status'])) {
            $this->_model = $this->_model->where('status', $filter['status']);
        }

        return $this->_model;
    }

    /**
     * 获取list页面搜索结果的参数过滤
     *
     * @return array
     */
    private function filterSearchParams()
    {
        $params['keyword'] = strip_tags(request()->get('keyword'));
        $params['status'] = intval(request()->get('status'));

        return array_filter($params);
    }
}
