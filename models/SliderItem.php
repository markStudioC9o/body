<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slider_item".
 *
 * @property int $id
 * @property int|null $slider_id
 * @property string|null $img
 * @property string|null $link
 * @property string|null $bottom
 * @property string $active
 * @property int|null $sort
 */
class SliderItem extends \yii\db\ActiveRecord
{

    public $image;
    public $ids;
    public static function tableName()
    {
        return 'slider_item';
    }

    public function rules()
    {
        return [
            [['slider_id', 'sort'], 'integer'],
            [['active'], 'string'],
            [['end_str','img', 'link', 'bottom'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, webp'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider_id' => 'Slider ID',
            'img' => 'Картинка слайда',
            'link' => 'Сылка',
            'bottom' => 'Текст кнопки',
            'active' => 'Активность',
            'sort' => 'Сортировка',
            'image' => 'Картинка слайда',
            'end_str' => 'Вторая строка кнопки'
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

    public function getSlide(){
        return $this->hasOne(SliderList::className(), ['slider_id' => 'id']);
    }
}
