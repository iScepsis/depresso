<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ds_categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $label
 * @property string $description
 * @property integer $parent_id
 * @property integer $is_active
 *
 * @property Categories $parent
 * @property Categories[] $categories
 * @property DsPosts[] $dsPosts
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'label'], 'required'],
            [['parent_id', 'is_active'], 'integer'],
            [['title', 'label', 'description'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['label'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Техническое название категории',
            'label' => 'Название категории',
            'description' => 'Краткое описание категории',
            'parent_id' => 'id родительской категории',
            'is_active' => 'Активна ли категория',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Categories::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDsPosts()
    {
        return $this->hasMany(DsPosts::className(), ['fid_category' => 'id']);
    }
}
