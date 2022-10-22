<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
class Authors extends ActiveRecord
{
    public $image;

    public static function tableName()
    {
        return 'authors';
    }

    public function behaviors()
         {
             return [
                 'timestamp' => [
                     'class' => 'yii\behaviors\TimestampBehavior',
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                        //  ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                     ],
                 ],
             ];
         }

    public function rules()
    {
        return [
            [['photo', 'name', 'date', 'link'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, svg, webp'],
            ['default_author', 'in', 'range' => [0, 1], 'allowArray' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Фото',
            'name' => 'Имя',
            'date' => 'Дата',
            'link' => 'Ссылка',
            'default_author'=> 'По умолчанию'
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $file = "authors-".rand(0,999)."-".date('Y-m-d').".".$this->image->extension;
            $url = Yii::getAlias('@webroot')."/authors/".$file;
            $this->image->saveAs($url);
            return $file;
        }else{
            return false;
        }
    }
}
