<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "heading_lang".
 *
 * @property int $id
 * @property int|null $heading_id
 * @property string|null $title
 * @property string|null $descript
 * @property string|null $key_meta
 * @property string|null $date
 * @property string|null $date_up
 * @property int|null $parent_id
 * @property int|null $sort
 * @property string|null $text
 * @property string $col
 * @property string|null $tag
 */
class HeadingLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'heading_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['heading_id', 'parent_id', 'sort'], 'integer'],
            [['text', 'col'], 'string'],
            [['title', 'descript', 'key_meta', 'date', 'date_up'], 'string', 'max' => 300],
            [['tag', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heading_id' => 'Heading ID',
            'title' => 'Title',
            'descript' => 'Descript',
            'key_meta' => 'Key Meta',
            'date' => 'Date',
            'date_up' => 'Date Up',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'text' => 'Text',
            'col' => 'Col',
            'tag' => 'Tag',
        ];
    }
}
