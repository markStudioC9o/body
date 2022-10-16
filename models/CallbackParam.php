<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callback_param".
 *
 * @property int $id
 * @property string $param
 * @property string|null $value
 * @property int $widget_id
 */
class CallbackParam extends \yii\db\ActiveRecord
{
  public $image;
  public static function tableName()
  {
    return 'callback_param';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['param', 'widget_id'], 'required'],
      [['value'], 'string'],
      [['widget_id'], 'integer'],
      [['param'], 'string', 'max' => 255],
      [['image'], 'file', 'extensions' => 'png, jpg, jpeg, svg, webp']
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
      'widget_id' => 'Widget ID',
    ];
  }

  public function upload()
  {
    if ($this->validate()) {
      $file = "callback-" . rand(0, 999) . "-" . date('Y-m-d') . "." . $this->image->extension;
      $url = Yii::getAlias('@webroot') . "/callback/" . $file;
      $this->image->saveAs($url);
      return $file;
    } else {
      return false;
    }
  }
}
