<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "footer_header_param".
 *
 * @property int $id
 * @property string|null $param
 * @property string|null $value
 * @property string|null $data
 */
class FooterHeaderParam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'footer_header_param';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['value'], 'string'],
            [['param', 'data'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Param',
            'value' => 'Value',
            'data' => 'Data',
        ];
    }
}
