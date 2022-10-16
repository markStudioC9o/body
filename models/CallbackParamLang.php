<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callback_param_lang".
 *
 * @property int $id
 * @property string $param
 * @property string|null $value
 * @property int $widget_id
 */
class CallbackParamLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback_param_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param', 'tag', 'widget_id'], 'required'],
            [['value'], 'string'],
            [['widget_id'], 'integer'],
            [['param', 'tag'], 'string', 'max' => 255],
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
            'widget_id' => 'Widget ID',
        ];
    }
}
