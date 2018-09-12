<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsExportRequest;
use App\Services\GoodsExportService;
use Illuminate\Http\Request;

class GoodsExportController extends Controller
{
    // list 数据获取
    public function index(GoodsExportService $service)
    {
        $results['data'] = $service->getList();

        return view('admin.goods_export.index', ['results' => $results]);
    }

    // 编辑
    public function create(Request $request, GoodsExportService $service)
    {
        $results['form'] = $service->getForm();

        return view('admin.goods_export.create', ['results' => $results]);
    }

    // 保存数据
    public function store(GoodsExportRequest $request, GoodsExportService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params);

        return $results;
    }

    // 编辑数据
    public function edit(Request $request, GoodsExportService $service)
    {
        $results['detail'] = $service->getDetail($request->goods_export_id);
        $results['form'] = $service->getForm();

        return view('admin.goods_export.edit', ['results' => $results]);
    }

    // 更新
    public function update(GoodsExportRequest $request, GoodsExportService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params, $request->goods_export_id);

        return $results;
    }

    // 删除
    public function destroy(Request $request, GoodsExportService $service)
    {
        $results['status'] = $service->delete($request->goods_export_id);

        return $results;
    }


}
