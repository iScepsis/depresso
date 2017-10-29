<?php

namespace common\components;

use frontend\models\User;
use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public $a1 = 'xexexex';
    public $a2 = 'bebebebeb';
    public $owner; //Сюда будут подключены все методы и атрибуты того класса к которому они подключены

    public function test(){
        var_dump($this->owner);
    }

    public function events()
    {
        return [
            User::MY_EVENT => 'echoStuff'
        ];
    }

    public function echoStuff(){
        echo 'Какая-то фигня';
    }
}
