<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "language_setting".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $short
 * @property string|null $tag
 */
class LanguageSetting extends ActiveRecord
{
    public $image;
    
    public static function tableName()
    {
        return 'language_setting';
    }

    
    public function rules()
    {
        return [
            [['name', 'short', 'tag', 'icon'], 'string', 'max' => 255],
            [['image'], 'file','checkExtensionByMimeType' => false, 'extensions' => 'jpeg, png, jpg, svg, webp'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short' => 'Short',
            'tag' => 'Tag',
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $file = "lang-".rand(0,999)."-".date('Y-m-d').".".$this->image->extension;
            $url = Yii::getAlias('@webroot')."/lang/".$file;
            if($this->image->saveAs($url)){
                return $file;
            }else{
                return $this->getErrors();    
            }
        }else{
            return $this->getErrors();    
        }
            
    }
}
