<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $content
 * @property string|null $date
 */
class Articles extends ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'articles';
  }

  public function behaviors()
  {
    return [
      'timestamp' => [
        'class' => 'yii\behaviors\TimestampBehavior',
        'attributes' => [
          ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
          ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
        ],
      ],
    ];
  }

  public function rules()
  {
    return [
      [['content'], 'string'],
      [['text', 'date', 'updated_at'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'text' => 'Text',
      'content' => 'Content',
      'date' => 'Дата добавления',
      'updated_at' => 'Последние изменение',
    ];
  }

  public function getHeading()
  {
    $option = ArticlesOption::find()->where(['articles_id' => $this->id])->andWhere(['option_param' => 'heading'])->one();
    if (!empty($option)) {
      $rest = json_decode($option->value, true);
      $heading = Heading::find()->where(['id' => $rest])->asArray()->all();
      return $heading;
    }else{
      return null;
    }
  }

  public function getMainHeading()
  {
    $option = ArticlesOption::find()->where(['articles_id' => $this->id])->andWhere(['option_param' => 'mainHeading'])->one();
    if (!empty($option)) {
      $heading = Heading::find()->where(['id' => $option->value])->asArray()->one();
      return $heading;
    }else{
      return null;
    }
  }

  public function getMHeading()
  {
    $option = ArticlesOption::find()->where(['articles_id' => $this->id])->andWhere(['option_param' => 'mainHeading'])->one();
    if (!empty($option)) {
      $heading = Heading::find()->where(['id' => $option->value])->one();
      return $heading;
    }else{
      return null;
    }
  }

  public function getVersion($id, $size, $lang){
    if(ArticleLang::find()->where(['parent_id' => $id])->andWhere(['size' => $size])->andWhere(['lang' => $lang])->exists()){
      return true;
    }else{
      return false;
    }
  }
}