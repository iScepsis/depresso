<?php

namespace frontend\controllers;

use common\models\Categories;
use common\models\Posts;
use common\models\search\CategoriesSearch;
use yii\web\Controller;
use yii\data\Pagination;



class CategoriesController extends Controller
{

    public function actionIndex($id){
        $categories = Categories::find()->where(['id' => $id])->one();

        if (!empty($categories)) {
            $postsQuery = Posts::find()->where(['fid_category' => $id]);
            $postsCount = clone $postsQuery;
            $pages = new Pagination(['totalCount' => $postsCount->count(), 'pageSize' => 10]);
            $pages->pageSizeParam = false;
            $models = $postsQuery->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', [
                'models' => $models,
                'pages' => $pages,
            ]);
        } else {
            //TODO::404
        }
    }

}
