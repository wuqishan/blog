<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UploadService;

class UploadController extends Controller
{
    public function photo(UploadService $service)
    {
        $results = $service->storePhoto();

    }
}
