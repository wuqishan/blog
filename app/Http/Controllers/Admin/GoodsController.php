<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsRequest;
use App\Services\GoodsService;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index(GoodsService $service)
    {
        $results['data'] = $service->getList();

        return view('admin.goods.index', ['results' => $results]);
    }

    /**
     * 编辑
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        return view('admin.goods.create');
    }
    public function store(GoodsRequest $request, GoodsService $service)
    {
        $params = $request->all();
        $this->results['status'] = (bool) $service->normalSaveData($params);

        return $this->results;
    }
    public function edit(Request $request, GoodsService $service)
    {
        $results['detail'] = $service->getDetail($request->goods_id);

        return view('admin.goods.edit');
    }
    public function update()
    {

    }


}
