<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $counries_id
 */
class Cities extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'cities';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name', 'counries_id'], 'required'],
      [['counries_id'], 'integer'],
      [['name', 'postscript'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'counries_id' => 'Counries ID',
      'postscript' => 'postscript'
    ];
  }

  public function getFlag()
  {
    $count = Countries::findOne($this->counries_id);
    return LanguageSetting::find()->where(['tag' => $count->tag])->one();
  }
}
