<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gqllery_html".
 *
 * @property int $id
 * @property string|null $value
 * @property string|null $date
 */
class GqlleryHtml extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gqllery_html';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['date'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'date' => 'Date',
            'name' => 'Name'
        ];
    }
}
