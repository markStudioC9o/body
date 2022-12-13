<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cillbac_option_lang".
 *
 * @property int $id
 * @property string $param
 * @property string|null $value
 * @property int $parent_id
 * @property string $tag
 */
class CillbacOptionLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cillbac_option_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param', 'parent_id', 'tag'], 'required'],
            [['value'], 'string'],
            [['parent_id'], 'integer'],
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
            'parent_id' => 'Parent ID',
            'tag' => 'Tag',
        ];
    }
}
