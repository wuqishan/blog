<?php

namespace App\Services;

class Service
{
    public $_length;
    public $_offset;
    public $_sort_field;
    public $_sort_type;

    public function __construct()
    {
        $this->_length = request()->get('length', 10);
        $this->_offset = request()->get('start', 0);
        $order = request()->get('order');
        $columns = request()->get('columns');
        if (isset($order[0]['column']) && $columns[$order[0]['column']]['data'] && isset($order[0]['dir'])) {
            $this->_sort_field = $columns[$order[0]['column']]['data'];
            $this->_sort_type = $order[0]['dir'];
        }
    }
}
