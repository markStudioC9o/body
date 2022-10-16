<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles_stec".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $text
 * @property string|null $content
 * @property string|null $tag
 * @property string|null $size
 * @property string|null $date
 * @property string|null $updated_at
 */
class ArticlesStec extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles_stec';
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
            [['text', 'tag', 'size', 'date', 'updated_at'], 'string', 'max' => 255],
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
            'tag' => 'Tag',
            'size' => 'Size',
            'date' => 'Date',
            'updated_at' => 'Updated At',
        ];
    }
}
