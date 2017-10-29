<?php
namespace backend\models;

use yii\base\Model;

class User2 extends Model {
    const USER_REGISTERED = 'user registered';


    public static function twoMethod($event){
        var_dump('bbbbbbbbbbbbb');
        //$event->handled = true;
    }

}