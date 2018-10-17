<?php

namespace App\Services;

use App\Model\Goods;

class UserService extends Service
{
    public $_model = null;

    public function __construct()
    {
        parent::__construct();
//        $this->_model = new ();
    }

    /**
     * list 显示
     *
     * @return array
     */
    public function getList()
    {
        $results['length'] = $this->_length;
        $results['list'] = [];

        $this->_model = $this->listWhere();
        $results['total'] = $this->_model->count('id');  // 在分页查询前获取总数量
        $this->_model->offset($this->_offset)->limit($this->_length);
        $dataModel = $this->_model->get();

        if (! empty($dataModel)) {
            $results['list'] = $dataModel->toArray();
        }

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
        $dataModel = $this->_model->find($id);
        if (! empty($dataModel)) {
            $results = $dataModel->toArray();
        }
        $results['images'] = $images;

        return $results;
    }


    public function saveData($params, $id = 0)
    {
        $id = intval($id);
        if ($id > 0) {
            $detail = $this->_model->find($id);
            if (! empty($detail)) {
                $detail->title = strip_tags($params['title']);
                $detail->unit = strip_tags($params['unit']);
                $detail->status = intval($params['status']);
                $detail->description = strip_tags($params['description']);
                $detail->save();
            }
        } else {
            $data = [
                'title' => strip_tags($params['title']),
                'unit' => strip_tags($params['unit']),
                'status' => intval($params['status']),
                'images' => '',
                'deleted' => 1,
                'description' => strip_tags($params['description'])
            ];
            $id = $this->_model->insertGetId($data);
        }

        // 更新图片信息
        if (isset($params['image_id'])) {
            $filesService = new FilesService();
            $filesService->updateType($params['image_id'], $id, self::IMAGE_TYPE);
        }

        return $id;
    }

    /**
     * 删除数据 1：未删除；2：删除
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $results = (bool) $this->_model->where('id', $id)->update(['deleted' => 2]);

        return $results;
    }

    /**
     * 更新商品的库存
     *
     * @param $goods_id
     * @return int
     */
    public function updateStock($goods_id)
    {
        $goodsExportService = new GoodsExportService();
        $goodsImportService = new GoodsImportService();
        $goodsExportNumber = $goodsExportService->getGoodsExport($goods_id);
        $goodsImportNumber = $goodsImportService->getGoodsImport($goods_id);

        $results = (bool) $this->_model->where('id', $goods_id)
            ->update(['stock' => ($goodsImportNumber - $goodsExportNumber)]);

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
