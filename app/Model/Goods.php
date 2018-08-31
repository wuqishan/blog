<?php

namespace App\Model;

class Goods extends BaseModel
{
    protected $table = 'goods';

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * [{字段名称}, {处理方法}, {insert的默认值}]
     *
     * @var array
     */
    protected $saveFields = [
        ['title', 'self::removeHtml', ''],
        ['description', 'self::removeHtml', ''],
        ['images', '', ''],
        ['stock', 'self::int', 0],
        ['import_number', 'self::int', 0],
        ['export_number', 'self::int', 0],
        ['unit', 'self::removeHtml', ''],
        ['status', 'self::int', 1],
        ['deleted', 'self::int', 1]
    ];

    /**
     * 获取字段信息配置
     *
     * @return array
     */
    public function getSaveFields()
    {
        return $this->saveFields;
    }


}
