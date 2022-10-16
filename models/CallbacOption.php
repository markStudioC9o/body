<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callbac_option".
 *
 * @property int $id
 * @property string|null $param
 * @property string|null $value
 */
class CallbacOption extends \yii\db\ActiveRecord
{
  
  public static function tableName()
  {
    return 'callbac_option';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['param'], 'string', 'max' => 255],
      [['value'], 'string'],
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
    ];
  }
}
