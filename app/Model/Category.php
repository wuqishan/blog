<?php

namespace App\Model;

class Category extends BaseModel
{
    protected $table = 'categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
