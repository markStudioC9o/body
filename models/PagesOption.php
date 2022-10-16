<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages_option".
 *
 * @property int $id
 * @property int|null $pages_id
 * @property string|null $value
 * @property string|null $option_param
 */
class PagesOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pages_id'], 'integer'],
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
            'pages_id' => 'Pages ID',
            'value' => 'Value',
            'option_param' => 'Option Param',
        ];
    }
}
