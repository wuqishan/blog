<?php

namespace App\Services;

class Service
{
    public $_length;
    public $_offset;
    public $_sortField;
    public $_sortType;

    public function __construct()
    {
        $this->_length = request()->get('length', 10);
        $this->_offset = request()->get('start', 0);
        $order = request()->get('order');
        $columns = request()->get('columns');
        $this->_sortField = $columns[$order[0]['column']]['data'];
        $this->_sortType = $order[0]['dir'];
    }
}
