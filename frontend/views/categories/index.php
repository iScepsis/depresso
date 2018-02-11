<?php

use yii\bootstrap\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $models array of common\models\Posts */
/* @var $model common\models\Posts */
/* @var $pages yii\data\Pagination */
?>


<?php if (empty($models)): ?>
    <div>
        <?= Html::img('@web/images/empty_category.png', ['width' => '100%']); ?>
    </div>
    <h4>
        По данной категории пока нет не одной статьи. Но мы усиленно трудимся над их написанием!
    </h4>
<?php endif; ?>

<?php foreach ($models as $model): ?>
    <div class="post-main">
        <div class="post-header">
            <?= Html::a($model->label, ['posts/view', 'id' => $model->id]) ?>
        </div>
        <div class="post-preview">
            <?= $model->content ?>
        </div>
        <div class="post-footer">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                Создано: <?= date("d.m.Y", strtotime($model->created_at)) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                Автор: <?= $model->user->username ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                <span class="glyphicon glyphicon-eye-open"></span> <?= $model->views_count ?>
                <span class="glyphicon glyphicon-thumbs-up"></span> <?= $model->likes_count ?>
                <span class="glyphicon glyphicon-thumbs-down"></span> <?= $model->dislikes_count ?>
            </div>
        </div>
    </div>
<?php endforeach;  ?>

<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>