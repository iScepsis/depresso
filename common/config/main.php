<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'd.m.Y',
            'datetimeFormat' => 'd.m.Y H:i:s',
            'timeFormat' => 'H:i:s',

            'locale' => 'ru-RU', //your language locale
            'defaultTimeZone' => 'Europe/Moscow', // time zone
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

];
