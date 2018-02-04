<?php

use common\models\Categories;
use common\models\User;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
//$this->registerJsFile('@web/js/ckeditor/plugins/base64image/plugin.js');
//$this->registerJs("CKEDITOR.plugins.addExternal('base64image');");
//
?>



<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fid_category')->widget(Select2::classname(), [
        'data' =>  ArrayHelper::map(Categories::find()->orderBy('label asc')->all(), 'id', 'label'),
        'options' => [
            'placeholder' => 'Без категории',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['preset' => 'custom', 'clientOptions' => [
       // 'extraPlugins' => 'base64image',
        'toolbarGroups' => [
            ['name' => 'undo'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
            ['name' => 'colors'],
            ['name' => 'links', 'groups' => ['links', 'insert']],
            ['name' => 'others', 'groups' => ['others', 'about']],

       //     ['name' => 'base64image']
        ]
    ]]); ?>

    <?= $form->field($model, 'created_at')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'size' => 'ms',
        'value' => Yii::$app->formatter->asDatetime($model->created_at),
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd HH:ii:ss',
        ]
    ]); ?>

    <?php if (Yii::$app->user->can('admin')): ?>

        <?= $form->field($model, 'views_count')->input('number', ['min' => 0, 'max' => '2147483647']) ?>

        <?= $form->field($model, 'likes_count')->input('number', ['min' => 0, 'max' => '2147483647']) ?>

        <?= $form->field($model, 'dislikes_count')->input('number', ['min' => 0, 'max' => '2147483647']) ?>

        <?php if (!$model->isNewRecord): ?>

            <?= $form->field($model, 'fid_user')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(User::find()->orderBy('username asc')->all(), 'id', 'username'),
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

        <?php endif; ?>

    <?php endif; ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
