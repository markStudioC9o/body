<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities_lang".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $tag
 */
class CitiesLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'tag'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'tag', 'postscript'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'tag' => 'Tag',
            'postscript' => 'postscript'
        ];
    }

    public function getFlag(){
      $citys = Cities::find()->where(['id' => $this->parent_id])->one();
      $count = Countries::findOne($citys->counries_id);
      return LanguageSetting::find()->where(['tag' => $count->tag])->one();
    }
}
