<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_lang".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $text
 * @property string|null $content
 * @property string|null $date
 * @property string|null $updated_at
 * @property string|null $lang
 */
class ArticleLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['content'], 'string'],
            [['size','text', 'date', 'updated_at', 'lang'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'text' => 'Text',
            'content' => 'Content',
            'date' => 'Date',
            'updated_at' => 'Updated At',
            'lang' => 'Язык',
            'size' => 'Размер'
        ];
    }
}
