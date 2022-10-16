<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video_list".
 *
 * @property int $id
 * @property string|null $page_id
 * @property string|null $key_id
 * @property string|null $date
 */
class VideoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'key_id', 'date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'key_id' => 'Key ID',
            'date' => 'Date',
        ];
    }
}
