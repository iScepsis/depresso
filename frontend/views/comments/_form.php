<?php
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $post_id int - id поста */
/* @var $comment common\models\Comments */

?>

<div id="comment-form">
    <?php
    $form = ActiveForm::begin(['action' => ['comments/create'], 'options' => ['data-pjax' => true]]);
    ?>

    <?= $form->field($comment, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ])->label('Оставить комментарий'); ?>

    <?= $form->field($comment, 'fid_post')->hiddenInput()->label(false); ?>

    <?= $form->field($comment, 'parent_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save-comment-btn']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>