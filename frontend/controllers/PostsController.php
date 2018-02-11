<?php

namespace frontend\controllers;

use common\models\Posts;
use yii\web\Controller;



class PostsController extends Controller
{

    public function actionView($id){
        $post = Posts::findOne($id);
        if (!empty($post)) {
           return $this->render('view', [
               'post' => $post
           ]);
        } else {
            //TODO: not found
        }
    }

}
