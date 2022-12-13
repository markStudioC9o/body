<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callbac_widget_lang".
 *
 * @property int $id
 * @property string $name
 * @property string $active
 * @property string $tag
 */
class CallbacWidgetLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callbac_widget_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tag'], 'required'],
            [['active'], 'string'],
            [['parent_id'], 'integer'],
            [['name', 'tag'], 'string', 'max' => 255],
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
            'active' => 'Active',
            'tag' => 'Tag',
        ];
    }
}
