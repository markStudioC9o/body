<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "countries_lang".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $tag
 */
class CountriesLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'name'], 'required'],
            [['parent_id'], 'integer'],
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
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'tag' => 'Tag',
        ];
    }

    public function getCitiesfield(){
      $country = Countries::find()->where(['id' => $this->parent_id])->one();
      $city = Cities::find()->where(['counries_id' => $country->id])->all();
      $cityIds = ArrayHelper::getColumn($city, 'id');
      return CitiesLang::find()->where(['parent_id' => $cityIds])->andWhere(['tag' => $this->tag])->all();
    }
}
