<?php

namespace App\Helper;

class OptionBtnHelper
{
    /**
     * @param $type
     * @param string $action
     * @param array $attr
     * @return string
     */
    public static function get($type, $action = '', $attr = [])
    {
        $icon = '';
        $title = '';
        $class = '';
        $btnPtn = '<a href="%s" class="badge badge-dark %s" %s>%s</a>';
        switch ($type) {
            case 'edit':
                $icon = '<i class="fa fa-edit" aria-hidden="true"></i> 编辑';
                $class = 'my-edit';
                break;
            case 'del':
                $icon = '<i class="fa fa-trash-o" aria-hidden="true"></i> 删除';
                $attr['onclick'] = $action;
                $action = 'javascript:void(0);';
                $class = 'my-del';
                break;
            case 'detail':
                $icon = '<i class="fa fa-clone" aria-hidden="true"></i> 详情';
                $class = 'my-detail';
                break;
        }
        $attr_arr = [];
        if (! empty($attr)) {
            foreach ($attr as $k => $v) {
                $attr_arr[] = "{$k}=\"{$v}\"";
            }
        }
        $btn = sprintf($btnPtn, $action, $class, implode(' ', $attr_arr), $icon);

        return $btn;
    }


}

