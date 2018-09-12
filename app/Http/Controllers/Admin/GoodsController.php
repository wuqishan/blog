<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsRequest;
use App\Services\GoodsService;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    // list
    public function index(GoodsService $service)
    {
        $results['data'] = $service->getList();

        return view('admin.goods.index', ['results' => $results]);
    }

    // 新增 get
    public function create(Request $request)
    {
        return view('admin.goods.create');
    }

    // 新增 post
    public function store(GoodsRequest $request, GoodsService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params);

        return $results;
    }

    // 编辑 get
    public function edit(Request $request, GoodsService $service)
    {
        $results['detail'] = $service->getDetail($request->goods_id);

        return view('admin.goods.edit', ['results' => $results]);
    }

    // 编辑 post
    public function update(GoodsRequest $request, GoodsService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params, $request->goods_id);

        return $results;
    }

    // 删除
    public function destroy(Request $request, GoodsService $service)
    {
        $results['status'] = $service->delete($request->goods_id);

        return $results;
    }
}
