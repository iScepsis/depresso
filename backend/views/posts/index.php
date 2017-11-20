<?php

use common\models\Categories;
use common\models\User;
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
                    'name' => 'PostsSearch[category.label]',
                    'value' => Yii::$app->request->get('PostsSearch')['category.label'],
                    'data' => ArrayHelper::map(Categories::find()->all(), 'label', 'label'),
                    'options' => ['placeholder' => 'Все категории'],
                    'pluginOptions' => ['allowClear' => true]
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
                'attribute' => 'user.username',
                'filter' => Select2::widget([
                    'name' => 'PostsSearch[user.username]',
                    'value' => Yii::$app->request->get('PostsSearch')['user.username'],
                    'data' => ArrayHelper::map(User::find()->all(), 'username', 'username'),
                    'options' => ['placeholder' => 'Все авторы'],
                    'pluginOptions' => ['allowClear' => true]
                ])
             ],
             'is_active:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
