<?php

namespace frontend\controllers;

use common\components\comments\Comments;
use common\models\Posts;
use yii\web\Controller;



class PostsController extends Controller
{

    public function actionView($id){
        $post = Posts::findOne($id);
        if (!empty($post)) {
           $post->views_count++;
           $post->save();
           return $this->render('view', [
               'post' => $post,
               'comments' => new Comments(['view' => $this->getView()])
           ]);
        } else {
            //TODO: not found
        }
    }

}
