<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ds_comments".
 *
 * @property integer $id
 * @property integer $fid_post
 * @property integer $fid_user
 * @property string $content
 * @property integer $parent_id
 * @property string $created_at
 * @property integer $is_ban
 * @property integer $likes_count
 *
 * @property Posts $fidPost
 * @property User $fidUser
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid_post', 'fid_user', 'content'], 'required'],
            [['fid_post', 'fid_user', 'parent_id', 'is_ban', 'likes_count'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['fid_post'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['fid_post' => 'id']],
            [['fid_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fid_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fid_post' => 'id статьи к которой был оставлен данный комментарий',
            'fid_user' => 'id пользователя оставившего комментарий',
            'content' => 'Текст комментария',
            'parent_id' => 'id родительского комментария',
            'created_at' => 'Время создания',
            'is_ban' => 'Комментарий нарушает правила ресурса и был удален',
            'likes_count' => 'Количество лайков',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'fid_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fid_user']);
    }

    public static function getCommentsForPost($id){
        return self::find()->joinWith('user')->where(['fid_post' => $id])->all();
    }
}
