<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callbac_widget".
 *
 * @property int $id
 * @property string $name
 * @property string $active
 */
class CallbacWidget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callbac_widget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active'], 'string'],
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
            'name' => 'Название',
            'active' => 'Включеность',
        ];
    }

    public function getOption(){
      return CallbackParam::find()->where(['widget_id' => $this->id])->asArray()->all();
    }
}
