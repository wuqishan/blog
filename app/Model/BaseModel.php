<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * int 类型过滤
     *
     * @param $params
     * @param $key
     * @return int
     */
    public static function int($params, $key)
    {
        return intval($params[$key]);
    }

    /**
     * 删除html
     *
     * @param $params
     * @param $key
     * @return string
     */
    public static function removeHtml($params, $key)
    {
        return strip_tags($params[$key]);
    }

    /**
     * html转义
     *
     * @param $params
     * @param $key
     * @return string
     */
    public static function transHtml($params, $key)
    {
        return htmlspecialchars($params[$key]);
    }

    /**
     * 过滤字段
     *
     * @param $params
     * @param $id
     * @return array
     */
    public function filterFields($params, $id)
    {
        $insert = [];

        // 这里不能直接用isset判断$params,因为如果值为null的话就算存在该键，也会为false
        $keys = array_keys($params);
        $key_flip = array_flip($keys);

        foreach ($this->saveFields as $v) {

            if ($id === 0) {
                if (isset($key_flip[$v[0]])) {
                    if ($v[1] === '') {
                        $insert[$v[0]] = $params[$v[0]];
                    } else {
                        $insert[$v[0]] = call_user_func_array($v[1], array($params, $v[0]));
                    }
                } else {
                    $insert[$v[0]] = isset($v[2]) ? $v[2] : '';
                }
            } else {
                if (isset($key_flip[$v[0]])) {
                    if ($v[1] === '') {
                        $insert[$v[0]] = $params[$v[0]];
                    } else {
                        $insert[$v[0]] = call_user_func_array($v[1], array($params, $v[0]));
                    }
                }

            }
        }

        return $insert;
    }
}
