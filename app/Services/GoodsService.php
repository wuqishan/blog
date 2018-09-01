<?php

namespace App\Services;

use App\Model\Goods;

class GoodsService extends Service
{

    const IMAGE_TYPE = 1;

    public $_model = null;

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
        $results = parent::getList();

        return $results;
    }

    /**
     * 详细页获取信息
     *
     * @param $id
     * @return mixed
     */
    public function getDetail($id)
    {
        $images = (new FilesService())->getFilesByObjectAndType($id, self::IMAGE_TYPE);
        $results = parent::getDetail($id);
        $results['images'] = $images;

        return $results;
    }


    public function saveData($params, $id = 0)
    {
        $goods_id = parent::saveData($params, $id);

        // 更新图片信息
        if (isset($params['image_id'])) {
            $filesService = new FilesService();
            $filesService->updateType($params['image_id'], $goods_id, self::IMAGE_TYPE);
        }

        return $goods_id;
    }

    /**
     * 删除数据
     *
     * @param $id
     * @param bool $flag
     * @return bool
     */
    public function delete($id, $flag = false)
    {
        $results = parent::delete($id, $flag);

        return $results;
    }

    /**
     * 获取搜索条件
     *
     * @return Goods|null
     */
    public function listWhere()
    {
        $filter = $this->filterSearchParams();

        // 处理条件
        $this->_model = $this->_model->where('deleted', 1);
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
        $params['keyword'] = strip_tags(request()->get('keyword'));
        $params['status'] = intval(request()->get('status'));
        $params['sort_field'] = strip_tags(request()->get('sort_field', 'id'));
        $params['sort_type'] = strip_tags(request()->get('sort_type', 'desc'));

        return array_filter($params);
    }
}
