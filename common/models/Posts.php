<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ds_posts".
 *
 * @property integer $id
 * @property integer $fid_category
 * @property string $title
 * @property string $label
 * @property string $content
 * @property string $created_at
 * @property integer $views_count
 * @property integer $likes_count
 * @property integer $dislikes_count
 * @property integer $fid_user
 * @property integer $is_active
 *
 * @property Categories $fidCategory
 * @property User $fidUser
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid_category', 'title', 'label', 'fid_user'], 'required'],
            [['fid_category', 'views_count', 'likes_count', 'dislikes_count', 'fid_user', 'is_active'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'label'], 'string', 'max' => 255],
            [['fid_category'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['fid_category' => 'id']],
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
            'fid_category' => 'id категории к которой принадлежит статья',
            'title' => 'Техническое название статьи',
            'label' => 'Название статьи',
            'content' => 'Контент статьи в виде html-разметки',
            'created_at' => 'Created At',
            'views_count' => 'Количество просмотров',
            'likes_count' => 'Количество лайков',
            'dislikes_count' => 'Количество дизлайков',
            'fid_user' => 'id пользователя создавшего статью',
            'is_active' => 'Активна ли статья',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'fid_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fid_user']);
    }
}
