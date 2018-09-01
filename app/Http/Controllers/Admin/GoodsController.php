<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsRequest;
use App\Services\GoodsService;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * list 数据获取
     *
     * @param GoodsService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * 保存数据
     *
     * @param GoodsRequest $request
     * @param GoodsService $service
     * @return array
     */
    public function store(GoodsRequest $request, GoodsService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params);

        return $results;
    }

    /**
     * 编辑数据
     *
     * @param Request $request
     * @param GoodsService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, GoodsService $service)
    {
        $results['detail'] = $service->getDetail($request->goods_id);

        return view('admin.goods.edit', ['results' => $results]);
    }

    /**
     * @param GoodsRequest $request
     * @param GoodsService $service
     * @return array
     */
    public function update(GoodsRequest $request, GoodsService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params, $request->goods_id);

        return $results;
    }

    /**
     * @param Request $request
     * @param GoodsService $service
     * @return array
     */
    public function destroy(Request $request, GoodsService $service)
    {
        $results['status'] = $service->delete($request->goods_id);

        return $results;
    }
}
