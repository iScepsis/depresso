<?php

namespace common\models\search;

use common\models\Categories;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `common\models\Posts`.
 */
class PostsSearch extends Posts
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fid_category', 'views_count', 'likes_count', 'dislikes_count', 'fid_user', 'is_active'], 'integer'],
            [['title', 'label', 'content', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Posts::find()->joinWith(['category', 'user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['category.label'] = [
            'asc' => [Categories::tableName().'.label' => SORT_ASC],
            'desc' => [Categories::tableName().'.label' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['user.username'] = [
            'asc' => [User::tableName().'.username' => SORT_ASC],
            'desc' => [User::tableName().'.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fid_category' => $this->fid_category,
            'created_at' => $this->created_at,
            'views_count' => $this->views_count,
            'likes_count' => $this->likes_count,
            'dislikes_count' => $this->dislikes_count,
            'fid_user' => $this->fid_user,
            'is_active' => $this->is_active,
            Categories::tableName().'.label' => Yii::$app->request->get('PostsSearch')['category.label'],
            User::tableName().'.username' => Yii::$app->request->get('PostsSearch')['user.username'],
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'content', $this->content]);
           // ->andFilterWhere(['like', Categories::tableName().'.label', Yii::$app->request->get('PostsSearch')['category.label'],]);

        return $dataProvider;
    }
}
