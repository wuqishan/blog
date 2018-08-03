<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request, CommentService $service)
    {
        $results['data'] = $service->getList();

        return view('admin.comment.index', ['results' => $results]);
    }

    public function changeShow(Request $request, CommentService $service)
    {
        $results = ['status' => false];
        $id = $request->id;
        $results['status'] = (bool) $service->changeShow($id, $request->all());

        return $results;
    }
}
