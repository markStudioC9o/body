<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_option".
 *
 * @property int $id
 * @property string|null $key_param
 * @property string|null $value
 * @property string|null $date
 */
class MainOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_param'], 'string', 'max' => 500],
            [['value'], 'string'],
            [['date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_param' => 'Key Param',
            'value' => 'Value',
            'date' => 'Date',
        ];
    }
}
