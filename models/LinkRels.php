<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "link_rels".
 *
 * @property int $id
 * @property string|null $old
 * @property string|null $new
 * @property string|null $date
 */
class LinkRels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_rels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old', 'new', 'date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old' => 'Old',
            'new' => 'New',
            'date' => 'Date',
        ];
    }
}
