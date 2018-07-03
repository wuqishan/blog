<?php

namespace App\Services;

class UploadService extends Service
{
    public function storePhoto()
    {
        $file = request()->file('photo');

        // 文件是否上传成功
        if ($file->isValid()) {

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            dd($originalName, $ext, $realPath, $type);

        }
    }
}
