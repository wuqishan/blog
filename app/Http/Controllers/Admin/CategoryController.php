<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create(Request $request)
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request, CategoryService $service)
    {
        $results = ['status' => false];
        $results['status'] = (bool) $service->saveData($request->all());

        return $results;
    }
}
