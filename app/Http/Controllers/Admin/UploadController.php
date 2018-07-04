<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TempFilesService;
use App\Services\UploadService;

class UploadController extends Controller
{
    public function photo(UploadService $service, TempFilesService $filesService)
    {
        $results = $service->storePhoto();
        $results['data']['id'] = $filesService->storeTempFiles($results['data']);

        return $results;
    }
}
