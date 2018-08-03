<?php

namespace App\Helper;

/**
 * 保存数据到数据库时，数据的处理函数
 *
 * Class SaveFilter
 * @package App\Helper
 */
class PrevSaveFormatterHelper
{
    public static function int($params, $k)
    {
        $params[$k] = (int) $params[$k];

        return $params;
    }

    public static function stripTags($params, $k)
    {
        $params[$k] = strip_tags($params[$k]);

        return $params;
    }
}

