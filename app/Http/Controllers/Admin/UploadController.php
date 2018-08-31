<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TempFilesService;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * 文件上传
     *      name  =>  $_FILES 里面键
     *      store =>  是否存入零时表
     * @param Request $request
     * @param UploadService $service
     * @param TempFilesService $filesService
     * @return array
     */
    public function upload(Request $request, UploadService $service, TempFilesService $filesService)
    {
        $name = $request->get('name', 'file');
        $results = $service->commonUpload($name);
        $results['data']['id'] = $filesService->storeTempFiles($results);

        return $results;
    }

    public function delete(Request $request, TempFilesService $service)
    {
        $results = ['status' => false];
        $id = (int) $request->id;
        if ($id > 0) {
            $results['status'] = (bool) $service->delete($id);
        }

        return $results;
    }
}
