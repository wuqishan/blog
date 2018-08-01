<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request, CategoryService $service)
    {
        $results['list'] = $service->getList();

        return view('admin.category.index', ['results' => $results]);
    }

    public function create(Request $request, CategoryService $service)
    {
        $results['form'] = $service->getForm();
        return view('admin.category.create', ['results' => $results]);
    }

    public function store(CategoryRequest $request, CategoryService $service)
    {
        $results = ['status' => false];
        $results['status'] = (bool) $service->saveData($request->all());

        return $results;
    }
}
