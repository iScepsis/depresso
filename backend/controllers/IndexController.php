<?php

namespace backend\controllers;

use backend\models\User;
use Yii;

use yii\web\Controller;


/**
 * PostsController implements the CRUD actions for Posts model.
 */
class IndexController extends Controller
{

    public function actionIndex(){

        #method 1
        $user = new User;
        /*$user->on(User::USER_REGISTERED, function($event){
            #var_dump($event->name);   //Название события
            #var_dump($event->sender);   //Модель в который было вызано событие
            #var_dump($event->data);
            var_dump($event->data);
        }, ['tp' => '666']);

        #method 2
        $user->on(User::USER_REGISTERED, [$user, 'someMethod']);

        #method 3
        $user->on(User::USER_REGISTERED, ['backend\models\User2', 'twoMethod']);

        #method 4 (глобальные методы php)
        $user->on(User::USER_REGISTERED, 'get_class');

        $user->trigger(User::USER_REGISTERED);*/

        $user->userRegistered();
        die();
    }

}
