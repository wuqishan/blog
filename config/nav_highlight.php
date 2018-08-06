<?php

/**
 * 左侧菜单高亮配置，这里配置的都是路由名称
 *
 */

return [
    'admin::family.index' => [
        'admin::family.index',
        'admin::family.create'
    ],
    'admin::category.index' => [
        'admin::category.index',
        'admin::category.edit',
        'admin::category.create'
    ],
    'admin::comment.index' => [
        'admin::comment.index'
    ],
    'admin::article.index' => [
        'admin::article.index',
        'admin::article.create',
        'admin::article.edit'
    ],
    //
];