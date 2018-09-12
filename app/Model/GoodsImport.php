<?php

namespace App\Model;

class GoodsImport extends BaseModel
{
    protected $table = 'goods_import';

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
