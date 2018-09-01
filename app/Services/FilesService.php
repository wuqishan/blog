<?php

namespace App\Services;

use App\Model\Files;

class FilesService extends Service
{
    /**
     * 新增
     *
     * @param $results
     * @return int
     */
    public function storeFiles($results)
    {
        $filesId = 0;
        if ($results['status']) {
            $results['data']['created_at'] = date('Y-m-d H:i:s');
            $filesId = Files::insertGetId($results['data']);
        }

        return $filesId;
    }

    /**
     * 更新数据
     *
     * @param $id
     * @param $type
     * @param $object_id
     * @return bool
     */
    public function updateType($id, $object_id, $type)
    {
        $results = false;
        if (is_array($id)) {
            $ids = array_map('intval', $id);
        } else {
            $ids = explode(',', $id);
        }
        $ids = array_unique($ids);
        $ids = array_filter($ids);

        $results = (bool) Files::whereIn('id', $ids)->update(['type' => $type, 'object_id' => $object_id]);

        return $results;
    }

    /**
     * 通过 object_id 和 type 获取图片信息
     *
     * @param $object_id
     * @param $type
     * @param array $fields
     * @return mixed
     */
    public function getFilesByObjectAndType($object_id, $type, $fields = [])
    {
        $results = [];
        if (empty($fields)) {
            $fields = ['id', 'filename', 'origin_name', 'filepath'];
        }
        $files = Files::where('object_id', $object_id)
            ->where('type', $type)
            ->select($fields)
            ->get();
        if (! empty($files)) {
            $results = $files->toArray();
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
        $file = Files::find($id);
        if (! empty($file)) {
            if ($flag) {
                $path = base_path('public') . $file->filepath . $file->filename;
                @unlink($path);
            }
        }

        return Files::destroy($id);
    }
}
