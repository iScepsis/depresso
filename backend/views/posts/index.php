<?php

use common\models\Categories;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'label',
            [                      // the owner name of the model
                'label' => 'Категория',
                'attribute' => 'category.label',
                'filter' => Select2::widget([
                    'name' => 'PostsSearch[category]',
                   // 'value' => '',
                    'data' => ArrayHelper::map(Categories::find()->all(), 'label', 'label'),
                    'options' => ['placeholder' => 'Все категории']
                ])
            ],
           // 'title',

            //'content:ntext',
             'created_at',
             'views_count',
             'likes_count',
             'dislikes_count',
             [                      // the owner name of the model
                'label' => 'Автор',
                'value' => 'user.username',
             ],
             'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
