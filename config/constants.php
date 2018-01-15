<?php
return [
    'blockType' => [
        1 => '静态',
        2 => '推荐',
        3 => '自动',
    ],
    'pageSize' => 10,   //每页显示数据数量
    'validateList' => [
        0 => '已删除',
        1 => '已通过',
        2 => '待审核',
        3 => '未通过审核',
    ],
    'webSite' => env('WEBSITE'),
    'imagePathFormat' => '/uploads/image/{yyyy}/{mm}/{dd}/', /* 上传保存路径,可以自定义保存路径和文件名格式 */
];
