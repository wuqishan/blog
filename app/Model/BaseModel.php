<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function int($params, $key)
    {
        return intval($params[$key]);
    }

    public static function removeHtml($params, $key)
    {
        return strip_tags($params[$key]);
    }

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
        foreach ($this->saveFields as $v) {

            if ($id === 0) {
                if (isset($params[$v[0]])) {
                    if ($v[1] === '') {
                        $insert[$v[0]] = $params[$v[0]];
                    } else {
                        $insert[$v[0]] = call_user_func_array($v[1], array($params, $v[0]));
                    }
                } else {
                    $insert[$v[0]] = isset($v[2]) ? $v[2] : '';
                }
            } else {
                if (isset($params[$v[0]])) {
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
