<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles_option".
 *
 * @property int $id
 * @property int|null $articles_id
 * @property string|null $value
 * @property string|null $option_param
 */
class ArticlesOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articles_id'], 'integer'],
            [['value'], 'string'],
            [['option_param'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'articles_id' => 'Articles ID',
            'value' => 'Value',
            'option_param' => 'Option Param',
        ];
    }

    public function getOption($articles_id){
      $model = ArticlesOption::find()->where(['articles_id' => $articles_id])->select(['value', 'option_param'])->asArray()->all();
      return $model;
    }
}
