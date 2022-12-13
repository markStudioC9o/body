<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles_option_lang".
 *
 * @property int $id
 * @property int|null $articles_id
 * @property string|null $value
 * @property string|null $option_param
 * @property string|null $tag
 */
class ArticlesOptionLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_option_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articles_id'], 'integer'],
            [['value'], 'string'],
            [['option_param', 'tag'], 'string', 'max' => 255],
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
            'tag' => 'Tag',
        ];
    }
}
