<?php

namespace App\Services;

use App\Model\TempFiles;

class TempFilesService extends Service
{
    public function storeTempFiles($temp_files)
    {
        $tempFilesId = 0;
        if (! empty($temp_files)) {
            $temp_files['created_at'] = date('Y-m-d H:i:s');
            $tempFilesId = TempFiles::insertGetId($temp_files);
        }

        return $tempFilesId;
    }
}
