<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_param".
 *
 * @property int $id
 * @property string|null $parent_id
 * @property string|null $value
 * @property string|null $ex_link
 * @property string|null $tag
 */
class MenuParam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_param';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'string', 'max' => 255],
            [['value', 'ex_link', 'tag'], 'string', 'max' => 500],
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
            'value' => 'Value',
            'ex_link' => 'Ex Link',
            'tag' => 'Tag',
        ];
    }

    public function Proms($id, $tag){
      $model = $this->find()->where(['parent_id' => $id])->andWhere(['tag' => $tag])->asArray()->one();
      return $model;
    }
    
}
