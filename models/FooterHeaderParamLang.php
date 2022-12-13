<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "footer_header_param_lang".
 *
 * @property int $id
 * @property string|null $param
 * @property string|null $value
 * @property string|null $data
 * @property string|null $tag
 */
class FooterHeaderParamLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'footer_header_param_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['param', 'data', 'tag'], 'string', 'max' => 255],
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
            'tag' => 'Tag',
        ];
    }
}
