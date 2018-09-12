<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // list
    public function index(CategoryService $service)
    {
        $results['data'] = $service->getList();

        return view('admin.category.index', ['results' => $results]);
    }

    // 新增 get
    public function create(CategoryService $service)
    {
        $results['form'] = $service->getForm();
        return view('admin.category.create', ['results' => $results]);
    }

    // 新增 post
    public function store(CategoryRequest $request, CategoryService $service)
    {
        $results = ['status' => false];
        $results['status'] = (bool) $service->saveData($request->all());

        return $results;
    }

    // 编辑 get
    public function edit(Request $request, CategoryService $service)
    {
        $results['detail'] = $service->getDetail($request->category_id);
        $results['form'] = $service->getForm();

        return view('admin.category.edit', ['results' => $results]);
    }

    // 编辑 post
    public function update(CategoryRequest $request, CategoryService $service)
    {
        $params = $request->all();
        $results['status'] = (bool) $service->saveData($params, $request->category_id);

        return $results;
    }

    // 删除
    public function destroy(Request $request, CategoryService $service)
    {
        $results['status'] = $service->delete($request->category_id);

        return $results;
    }
}
