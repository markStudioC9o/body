<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "widget_lang".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $param
 * @property string|null $date
 */
class WidgetLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['param'], 'string'],
            [['date', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'param' => 'Param',
            'date' => 'Date',
        ];
    }
}
