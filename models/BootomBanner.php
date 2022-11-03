<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class BootomBanner extends ActiveRecord
{
    public $image;
    public static function tableName()
    {
        return 'bootomBanner';
    }

    public function behaviors()
         {
             return [
                 'timestamp' => [
                     'class' => 'yii\behaviors\TimestampBehavior',
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['data'],
                     ],
                 ],
             ];
         }

    public function rules()
    {
        return [
            [['active'], 'string'],
            [['img', 'link', 'data', 'name'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, svg, webp']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'link' => 'Link',
            'active' => 'Active',
            'data' => 'Data',
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $file = "bb-".rand(0,999)."-".date('Y-m-d').".".$this->image->extension;
            $url = Yii::getAlias('@webroot')."/botom-banner/".$file;
            $this->image->saveAs($url);
            return $file;
        }else{
            return false;
        }
    }
}
