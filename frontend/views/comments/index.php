<?php

use \common\models\Comments as CommentModel;
use yii\widgets\Pjax;

/* @var $commentsComponent common\components\comments\Comments */
/* @var $post_id int */

?>


<?php Pjax::begin(['enablePushState' => false, 'timeout' => Yii::$app->params['pjaxTimeout']]); ?>

<?php
    $commentCount = CommentModel::find()->where(['fid_post' => $post_id])->andWhere(['!=', 'is_ban', 1])->count();
?>

<h4><u>Комментарии</u> (<?= $commentCount ?>):</h4>
<!-- Вывод списка комментариев к статье -->
<?= $this->render("_view", [
    'post_id' => $post_id,
    'commentsComponent' => $commentsComponent
]) ?>


<!-- Вывод формы создания комментария если у пользователя есть соответствующие права -->
<?php  ///if (!Yii::$app->user->isGuest && Yii::$app->user->):
//TODO: Поставить вывод формы комментариев в зависимости от уровня пользователя в RBAC модели
?>

<?= $this->render("_form", [
    'post_id' => $post_id,
    'comment' => new CommentModel(['fid_post' => $post_id])
]) ?>

<?php Pjax::end(); ?>
