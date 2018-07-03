<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FamilyRequest;
use App\Services\FamilyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function index(FamilyRequest $request, FamilyService $service)
    {
        if ($request->ajax()) {
            $params = $request->all();
            return $service->getFamilyByWhere($params);
        } else {
            return view('admin.family.index');
        }
    }

    public function store(FamilyRequest $request, FamilyService $service)
    {
        dd($request->all());
    }

    public function create(Request $request, FamilyService $service)
    {
        return view('admin.family.create');
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function edit()
    {

    }
}
