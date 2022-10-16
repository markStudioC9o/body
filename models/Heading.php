<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "heading".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $descript
 * @property string|null $key_meta
 * @property string|null $date
 * @property int|null $parent_id
 */
class Heading extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'heading';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
            [['title', 'descript', 'key_meta', 'date'], 'string', 'max' => 300],
            [['img', 'link'], 'string', 'max' => 255],
            [['text','col'], 'string'],
        ];
    }
    public function behaviors()
         {
             return [
                 'timestamp' => [
                     'class' => 'yii\behaviors\TimestampBehavior',
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['date', 'date_up'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['date_up'],
                     ],
                 ],
             ];
         }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'descript' => 'Descript (SEO)',
            'key_meta' => 'Key Meta (SEO)',
            'date' => 'Date',
            'parent_id' => 'Родительская рубрика',
            'col' => 'Внешний вид'
        ];
    }

    public function getArticles(){
      $model = ArticlesOption::find()->where(['like', 'value', $this->id])->andWhere(['option_param' => 'heading'])->all();
      return $model;
    }

    public function getArticl(){
      $model = ArticlesOption::find()->where(['like', 'value', $this->id])->andWhere(['option_param' => 'heading']);
      return $model;
    }

    public function getOption(){
      $model = HeadingOption::find()->where(['heading_id' => $this->id])->asArray()->all();
      return $model;
    }

    public function getHeading($id){
      $model = Heading::find()->where(['id' => $id])->asArray()->one();
      return $model;
    }
}
