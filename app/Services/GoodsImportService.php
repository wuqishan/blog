<?php

namespace App\Services;

use App\Model\GoodsExport;
use App\Model\GoodsImport;

class GoodsImportService extends Service
{

    const IMAGE_TYPE = 2;

    public $_model = null;
    public $_table = null;
    public $_joinTable = [];

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
        $this->_model = new GoodsImport();
        $this->_table = $this->_model->getTable();
        $this->_joinTable = ['goods'];
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
        $results['total'] = $this->_model->count($this->_table . '.id');  // 在分页查询前获取总数量
        $this->_model->offset($this->_offset)->limit($this->_length);
        $dataModel = $this->_model->select(
            [
                $this->_table.'.*',
                $this->_joinTable[0].'.title as goods_title',
                $this->_joinTable[0].'.unit as goods_unit',
                $this->_joinTable[0].'.status as goods_status',
                $this->_joinTable[0].'.stock as goods_stock',
            ]
        )->get();

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
        $goods_id = 0;
        if ($id > 0) {
            $detail = $this->_model->find($id);
            if (! empty($detail)) {
                $detail->goods_id = intval($params['goods_id']);
                $detail->number = intval($params['number']);
                $detail->images = '';
                $detail->description = strip_tags($params['description']);
                $detail->save();
                $goods_id = $detail->goods_id;
            }
        } else {
            $data = [
                'goods_id' => intval($params['goods_id']),
                'number' => intval($params['number']),
                'images' => '',
                'deleted' => 1,
                'description' => strip_tags($params['description'])
            ];
            $goods_id = intval($params['goods_id']);
            $id = $this->_model->insertGetId($data);
        }

        // 更新图片信息
        if (isset($params['image_id'])) {
            $filesService = new FilesService();
            $filesService->updateType($params['image_id'], $id, self::IMAGE_TYPE);
        }

        // 更新库存
        if ($goods_id > 0) {
            $goodsService = new GoodsService();
            $goodsService->updateStock($goods_id);
        }

        return $id;
    }

    /**
     * 删除数据
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
     * @return mixed
     */
    public function getForm()
    {
        $goodsService = new GoodsService();
        $results = $goodsService->getList();

        return $results['list'];
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsImport($goods_id)
    {
        $total = (int) $this->_model->where('goods_id', $goods_id)->where('deleted', 1)->sum('number');

        return $total;
    }

    /**
     * 获取搜索条件
     *
     * @return GoodsExport|null
     */
    public function listWhere()
    {
        $filter = $this->filterSearchParams();

        // 处理条件
        $this->_model = $this->_model->where($this->_table . '.deleted', 1)
            ->leftJoin($this->_joinTable[0], $this->_joinTable[0].'.id', '=', $this->_table . '.goods_id');

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
        $params['sort_field'] = strip_tags(request()->get('sort_field', $this->_table . '.id'));
        $params['sort_type'] = strip_tags(request()->get('sort_type', 'desc'));

        return array_filter($params);
    }
}
