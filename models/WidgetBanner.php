<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "widget_banner".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $img
 */
class WidgetBanner extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'widget_banner';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['parent_id'], 'integer'],
      [['img'],'string', 'max' => 255],
      [['img','parent_id'], 'required' ],
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
      'img' => 'Img',
    ];
  }
}
