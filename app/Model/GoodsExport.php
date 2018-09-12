<?php

namespace App\Model;

class GoodsExport extends BaseModel
{
    protected $table = 'goods_export';

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
