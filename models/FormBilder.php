<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form_bilder".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $value
 * @property string|null $data
 */
class FormBilder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_bilder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['name', 'data'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'data' => 'Data',
        ];
    }
}
