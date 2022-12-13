<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sort_header".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $value
 * @property string|null $param
 */
class SortHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sort_header';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['value'], 'string'],
            [['param'], 'string', 'max' => 255],
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
            'value' => 'Value',
            'param' => 'Param',
        ];
    }
}
