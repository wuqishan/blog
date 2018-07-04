<?php

namespace App\Services;

use App\Model\TempFiles;

class TempFilesService extends Service
{
    public function storeTempFiles($results)
    {
        $tempFilesId = 0;
        if ($results['status']) {
            $results['data']['created_at'] = date('Y-m-d H:i:s');
            $tempFilesId = TempFiles::insertGetId($results['data']);
        }

        return $tempFilesId;
    }

    /**
     * 删除
     *
     * @param $id
     * @param bool $flag
     * @return int
     */
    public function delete($id, $flag = true)
    {
        $file = TempFiles::find($id);
        if (! empty($file)) {
            if ($flag) {
                $path = base_path('public') . $file->filepath . $file->filename;
                @unlink($path);
            }
        }

        return TempFiles::destroy($id);
    }
}
