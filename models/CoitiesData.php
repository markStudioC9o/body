<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coities_data".
 *
 * @property int $id
 * @property int $cities_id
 * @property string|null $kontakty
 * @property string|null $adress
 * @property string $main
 * @property string $global
 */
class CoitiesData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coities_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cities_id'], 'required'],
            [['cities_id'], 'integer'],
            [['kontakty', 'adress', 'main', 'global'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cities_id' => 'Cities ID',
            'kontakty' => 'Kontakty',
            'adress' => 'Adress',
            'main' => 'Main',
            'global' => 'Global',
        ];
    }

    public function getThisCity(){
      return Cities::findOne($this->cities_id);
    }
}
