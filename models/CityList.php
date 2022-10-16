<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city_list".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $photo
 * @property string|null $text
 * @property string|null $lang
 * @property string|null $email
 */
class CityList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['name', 'phone', 'photo', 'lang', 'email'], 'string', 'max' => 255],
            [['name', 'phone'],'required']
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
            'phone' => 'Телефон',
            'photo' => 'Фото',
            'text' => 'Адресс / Дополнительный текст',
            'lang' => 'Языковые параметры',
            'email' => 'E-mail',
        ];
    }
}
