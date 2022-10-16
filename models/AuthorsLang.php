<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors_lang".
 *
 * @property int $id
 * @property string|null $param
 * @property int|null $parent_id
 * @property string|null $tag
 */
class AuthorsLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param'], 'string'],
            [['parent_id'], 'integer'],
            [['tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Param',
            'parent_id' => 'Parent ID',
            'tag' => 'Tag',
        ];
    }

    public function getLang(){
        return $this->hasOne(LanguageSetting::ClassName(), ['tag'=>'tag']);
    }
}
