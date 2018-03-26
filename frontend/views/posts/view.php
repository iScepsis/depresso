<?php

use common\components\comments\Comments;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $post common\models\Posts */

$comments = new Comments(['view' => $this]);

?>

<div>
    <h2><?= $post->label ?></h2>
    <div class="content-container">
        <?= $post->content ?>
    </div>
    <div class="comments-wrap">
        <?= $comments->showCommentsForPost($post->id); ?>
    </div>
    <div>
        <?php
        $comment = $comments->createCommentModel($post->id, 1);
        $form = ActiveForm::begin();
        ?>
        <?= $form->field($comment, 'content')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ])->label('Оставить комментарий'); ?>
        <?php ActiveForm::end() ?>
    </div>
</div>