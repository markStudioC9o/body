<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site_setting".
 *
 * @property int $id
 * @property string $param
 * @property string $value
 * @property string|null $tag
 */
class SiteSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param', 'value'], 'required'],
            [['value'], 'string'],
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
            'tag' => 'Tag',
        ];
    }
}
