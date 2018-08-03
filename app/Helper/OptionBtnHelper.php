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
        $btnPtn = '<a href="%s" data-toggle="tooltip" data-original-title="%s" class="badge badge-dark %s" %s>%s</a>';
        switch ($type) {
            case 'edit':
                $title = '编辑';
                $icon = '<i class="fa fa-edit" aria-hidden="true"></i>';
                $class = 'my-edit';
                break;
            case 'del':
                $title = '删除';
                $icon = '<i class="fa fa-trash-o" aria-hidden="true"></i>';
                $attr['onclick'] = $action;
                $action = 'javascript:void(0);';
                $class = 'my-del';
                break;
            case 'detail':
                $title = '详情';
                $icon = '<i class="fa fa-clone" aria-hidden="true"></i>';
                $class = 'my-detail';
                break;
        }
        $attr_arr = [];
        if (! empty($attr)) {
            foreach ($attr as $k => $v) {
                $attr_arr[] = "{$k}=\"{$v}\"";
            }
        }
        $btn = sprintf($btnPtn, $action, $title, $class, implode(' ', $attr_arr), $icon);

        return $btn;
    }


}

