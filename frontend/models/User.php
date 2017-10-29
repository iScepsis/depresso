<?php
namespace frontend\models;

use common\components\MyBehavior;
use yii\base\Model;

class User extends Model {

    const MY_EVENT = 'my event';

    public function behaviors()
    {
        return [
            [
                'class' => MyBehavior::className(),
                'a1' => 'fufufufufu' //устанавливаем свойсто подключаемого бехевиора
            ]
        ];

    }

    public function myEvent(){
        $this->trigger(self::MY_EVENT);
    }


}