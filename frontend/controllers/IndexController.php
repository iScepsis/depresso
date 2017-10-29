<?php

namespace frontend\controllers;

use frontend\models\User;
use Yii;

use yii\web\Controller;



class IndexController extends Controller
{

    public function actionIndex(){
        $user = new User();
        echo $user->a1;
        echo $user->a2;
        $user->test();
        $user->myEvent();
    }

}
