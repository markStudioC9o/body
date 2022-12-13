<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "heading_option".
 *
 * @property int $id
 * @property int $heading_id
 * @property string|null $option_param
 * @property string|null $value
 */
class HeadingOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'heading_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['heading_id'], 'required'],
            [['heading_id'], 'integer'],
            [['value'], 'string'],
            [['option_param'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heading_id' => 'Heading ID',
            'option_param' => 'Option Param',
            'value' => 'Value',
        ];
    }
}
