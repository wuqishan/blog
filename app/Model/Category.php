<?php

namespace App\Model;

class Category extends BaseModel
{
    protected $table = 'categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * [{字段名称}, {处理方法}, {insert的默认值}]
     *
     * @var array
     */
    protected $saveFields = [
        ['parent_id', 'self::int', 0],
        ['title', 'self::removeHtml', ''],
        ['description', 'self::removeHtml', ''],
        ['order', 'self::int', 0],
        ['level', 'self::int', 0]
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
