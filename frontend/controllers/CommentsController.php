<?php

namespace frontend\controllers;

use common\models\Posts;
use yii\web\Controller;
use common\components\comments\Comments as CommentComponent;
use Yii;



class CommentsController extends Controller
{

    public function actionCreate(){
        $comment = new \common\models\Comments();
        //TODO: Вернуть, когда будет напилена авторизация
        //$comment->fid_user = Yii::$app->user->id;
        $comment->fid_user = 1;
        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            $this->renderAjax('index', [
                'post_id' => $comment->fid_post,
                'commentsComponent' => new CommentComponent(['view' => $this->getView()])
            ]);
        }
    }

}