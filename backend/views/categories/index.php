<?php

use common\models\Categories;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'label',
            'description',
          //  'parent_id',
            [                      // the owner name of the model
                'label' => 'Категория',
                'attribute' => 'parent.label',
                'filter' => Select2::widget([
                    'name' => 'CategoriesSearch[parent.label]',
                    'value' => Yii::$app->request->get('CategoriesSearch')['parent.label'],
                    'data' => ArrayHelper::map(Categories::find()->where(['parent_id' => null])->all(), 'label', 'label'),
                    'options' => ['placeholder' => 'Все категории'],
                    'pluginOptions' => ['allowClear' => true]
                ])
            ],
            'is_active:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
