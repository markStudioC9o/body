<?php

namespace app\models;

use Yii;

class WidgetParam extends \yii\db\ActiveRecord
{
    public $image;
    public static function tableName()
    {
        return 'widget_param';
    }

    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['img', 'link'], 'string', 'max' => 255],
            ['image', 'file', 'extensions' => 'png, jpg, jpeg, gif, pdf, webp'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Баннер',
            'parent_id' => 'Parent ID',
            'img' => 'Баннер',
            'link' => 'Ссылка',
        ];
    }
    public function upload()
    {
        
            $file = "widget-".rand(0,999)."-".date('Y-m-d').".".$this->image->extension;
            $url = Yii::getAlias('@webroot')."/widget/".$file;
            if($this->image->saveAs($url)){
                return $file;
            }else{
                return false;
            }
    }
}
