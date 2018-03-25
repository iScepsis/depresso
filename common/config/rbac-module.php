<?php
return [
    'class' => 'mdm\admin\Module',
    'controllerMap' => [
        'assignment' => [
            'class' => 'mdm\admin\controllers\AssignmentController',
            /* 'userClassName' => 'app\models\User', */
            'idField' => 'id',
            'usernameField' => 'username',
            /*'fullnameField' => 'profile.full_name',
            'extraColumns' => [
                [
                    'attribute' => 'full_name',
                    'label' => 'Full Name',
                    'value' => function($model, $key, $index, $column) {
                        return $model->profile->full_name;
                    },
                ],
                [
                    'attribute' => 'dept_name',
                    'label' => 'Department',
                    'value' => function($model, $key, $index, $column) {
                        return $model->profile->dept->name;
                    },
                ],
                [
                    'attribute' => 'post_name',
                    'label' => 'Post',
                    'value' => function($model, $key, $index, $column) {
                        return $model->profile->post->name;
                    },
                ],
            ],
            'searchClass' => 'app\models\UserSearch'*/
        ],
    ],
    'layout' => 'left-menu',
    'mainLayout' => '@backend/views/layouts/main.php',
];