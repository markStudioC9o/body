<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_img".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $link
 * @property string $active
 */
class MenuImg extends \yii\db\ActiveRecord
{
    public $image;

    public static function tableName()
    {
        return 'menu_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'string', 'max' => 255],
            [['active'], 'string'],
            [['color','link'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
            'link' => 'Link',
            'active' => 'Active',
            'image' => 'Иконка'
        ];
    }

    
    public function upload()
    {
        if($this->validate()){
            $file = "icon-".rand(0,999)."-".date('Y-m-d').".".$this->image->extension;
            $url = Yii::getAlias('@webroot')."/icon/".$file;
            $this->image->saveAs($url);
            return $file;
        }else{
            return false;
        }
    }
}
