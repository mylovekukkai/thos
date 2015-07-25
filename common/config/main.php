<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'language'=>'th',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
];
