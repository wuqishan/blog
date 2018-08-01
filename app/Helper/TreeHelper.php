<?php

namespace App\Helper;

class TreeHelper
{
    /**
     * 生成无限极的树，多维数组
     *
     * @param $cate
     * @param int $parent_id
     * @param string $parent_name
     * @param string $child_name
     * @return array
     */
    public static function arrayToTree ($cate, $parent_id = 0, $parent_name = 'parent_id', $child_name = 'child')
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v[$parent_name] == $parent_id) {
                $v[$child_name] = static::arrayToTree($cate, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 生成一维数组，可以直接输出
     *
     * @param $cate
     * @param string $html
     * @param int $parent_id
     * @param int $level
     * @param string $parent_name
     * @return array
     */
    public static function unlimitedForLevel ($cate, $html = '--', $parent_id = 0, $level = 0, $parent_name = 'parent_id')
    {
        $arr = array();
        foreach ($cate as $k => $v) {
            if ($v[$parent_name] == $parent_id) {
                $v['html']  = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, static::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
            }
        }
        return $arr;
    }

    /**
     * 传入底层分类的id和总分类数组获取所有父级分类
     *
     * @param $cate
     * @param $id
     * @param string $parent_name
     * @return array
     */
    public static function getParents ($cate, $id, $parent_name = 'parent_id')
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['id'] == $id) {
                $arr[] = $v;
                $arr = array_merge(static::getParents($cate, $v[$parent_name]), $arr);
            }
        }
        return $arr;
    }
}

