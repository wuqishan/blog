<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, ArticleService $service)
    {
//        $results['data'] = $service->getList();

        return view('admin.article.index');
    }

    public function create(Request $request, ArticleService $service)
    {
        $results['form'] = $service->getForm();
        return view('admin.article.create', ['results' => $results]);
    }
    public function store()
    {

    }
    public function edit()
    {

    }
    public function update()
    {

    }


}
