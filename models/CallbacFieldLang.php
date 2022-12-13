<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callbac_field_lang".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property string $reqared
 * @property string $active
 * @property int $widget_1
 * @property string|null $tag
 */
class CallbacFieldLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callbac_field_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value', 'widget_1'], 'required'],
            [['reqared', 'active'], 'string'],
            [['widget_1'], 'integer'],
            [['name', 'value', 'tag'], 'string', 'max' => 255],
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
            'reqared' => 'Reqared',
            'active' => 'Active',
            'widget_1' => 'Widget  1',
            'tag' => 'Tag',
        ];
    }
}
