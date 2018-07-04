<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TempFilesService;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function photo(UploadService $service, TempFilesService $filesService)
    {
        $results = $service->storePhoto();
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
