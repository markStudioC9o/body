<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slider_list".
 *
 * @property int $id
 * @property string|null $name
 */
class SliderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование слайда',
        ];
    }
}
