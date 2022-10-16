<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "article_lang".
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $text
 * @property string|null $content
 * @property string|null $date
 * @property string|null $updated_at
 * @property string|null $lang
 */
class Shipet extends Model
{
  public $img;
  
  public function rules()
    {
        return [
            [['img'], 'file', 'extensions' => 'png, jpg, jpeg, svg, webp']
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $file = "shipet-".rand(0,999)."-".date('Y-m-d').".".$this->img->extension;
            $url = Yii::getAlias('@webroot')."/shipet/".$file;
            $this->img->saveAs($url);
            return $file;
        }else{
            return false;
        }
    }

}
