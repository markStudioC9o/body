<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slider_lang".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $img
 * @property string|null $link
 * @property string|null $bottom
 * @property string|null $end_str
 * @property string $active
 * @property int|null $sort
 * @property string|null $tag
 */
class SliderLang extends \yii\db\ActiveRecord
{
  public $image;
  public static function tableName()
  {
    return 'slider_lang';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['parent_id'], 'required'],
      [['parent_id', 'sort'], 'integer'],
      [['active'], 'string'],
      [['img', 'link', 'bottom', 'end_str', 'tag'], 'string', 'max' => 255],
      [['image'], 'file', 'extensions' => 'png, jpg, webp'],
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
      'link' => 'Link',
      'bottom' => 'Bottom',
      'end_str' => 'End Str',
      'active' => 'Active',
      'sort' => 'Sort',
      'tag' => 'Tag',
    ];
  }


  public function upload($ids)
  {
      if($this->validate()){
          $file = "slider-".$ids."-".rand(0,999)."-".date('Y-m-d').".".$this->image->extension;
          $url = Yii::getAlias('@webroot')."/slider/".$file;
          $this->image->saveAs($url);
          return $file;
      }else{
          return false;
      }
  }
  
}
