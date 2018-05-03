<?php
return [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        /*'site/*',
        'admin/*',
        'posts/*',
        'categories/*',
        'debug/*',
        'gii/*',
        'console/*',
        'yii/*',*/
        'debug/*',
        'gii/*',
        'yii/*',

        'posts/*',
        'categories/*',
        'site/login',
        'user/login'
        //'*'
        // The actions listed here will be allowed to everyone including guests.
        // So, 'admin/*' should not appear here in the production, of course.
        // But in the earlier stages of your development, you may probably want to
        // add a lot of actions here until you finally completed setting up rbac,
        // otherwise you may not even take a first step.
    ]
];