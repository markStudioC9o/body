<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages_lang".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $title
 * @property string|null $descript
 * @property string|null $keyword
 * @property string $tag
 */
class PagesLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'tag'], 'required'],
            [['parent_id'], 'integer'],
            [['link', 'title', 'tag'], 'string', 'max' => 255],
            [['descript', 'keyword'], 'string', 'max' => 500],
            [['link'], 'unique'],
            [['link','title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent_id' => 'Parent ID',
            'title' => 'Заголовок',
            'descript' => 'Descript',
            'keyword' => 'Keyword',
            'link' => 'Внутренняя ссылка',
            'ex_link' => 'Внешние ссылки',
            'tag' => 'Tag',
        ];
    }
}
