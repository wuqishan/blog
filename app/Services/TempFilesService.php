<?php

namespace App\Services;

use App\Model\TempFiles;

class TempFilesService extends Service
{
    /**
     * 新增
     *
     * @param $results
     * @return int
     */
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
     * 通过id获取路径
     *
     * @param $id
     * @return array
     */
    public function getUrl($id)
    {
        $results = [];
        if (is_array($id)) {
            $ids = array_map('intval', $id);
        } else {
            $ids = explode(',', $id);
        }
        $ids = array_unique($ids);
        $ids = array_filter($ids);
        $files = TempFiles::whereIn('id', $ids)->get();
        if (! empty($files)) {
            $results = array_map(function ($v) {
                return $v['filepath'] . $v['filename'];
            }, $files->toArray());
        }

        return $results;
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
