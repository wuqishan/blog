<?php

namespace App\Model;

class Goods extends BaseModel
{
    protected $table = 'users';

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
