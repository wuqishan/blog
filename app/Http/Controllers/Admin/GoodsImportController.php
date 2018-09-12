<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsImportRequest;
use App\Services\GoodsImportService;
use Illuminate\Http\Request;

class GoodsImportController extends Controller
{
    // list 数据获取
    public function index(GoodsImportService $service)
    {
        $results['data'] = $service->getList();

        return view('admin.goods_import.index', ['results' => $results]);
    }

    // 编辑
    public function create(Request $request, GoodsImportService $service)
    {
        $results['form'] = $service->getForm();

        return view('admin.goods_import.create', ['results' => $results]);
    }

    // 保存数据
    public function store(GoodsImportRequest $request, GoodsImportService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params);

        return $results;
    }

    // 编辑数据
    public function edit(Request $request, GoodsImportService $service)
    {
        $results['detail'] = $service->getDetail($request->goods_import_id);
        $results['form'] = $service->getForm();

        return view('admin.goods_import.edit', ['results' => $results]);
    }

    // 更新
    public function update(GoodsImportRequest $request, GoodsImportService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params, $request->goods_import_id);

        return $results;
    }

    // 删除
    public function destroy(Request $request, GoodsImportService $service)
    {
        $results['status'] = $service->delete($request->goods_import_id);

        return $results;
    }


}
