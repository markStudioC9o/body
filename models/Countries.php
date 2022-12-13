<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $name
 * @property string $tag
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tag'], 'required'],
            [['name', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'tag' => 'Tag',
        ];
    }

    public function getLang(){
      return CountriesLang::find()->where(['parent_id' => $this->id])->all();
    }

    public function getCiteslist(){
      return Cities::find()->where(['counries_id' => $this->id])->all();
    }
}
