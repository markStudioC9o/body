<?

use app\models\Cities;
use app\models\CoitiesData;
use yii\helpers\ArrayHelper;

 //print_r($model)?>
<?
  $mainCity = Cities::find()->where(['counries_id' => $model->id])->all();
  $cityId = ArrayHelper::getColumn($mainCity, 'id');
  $mainCount = CoitiesData::find()->where(['cities_id' => $cityId])->andWhere(['main' => '1'])->all();
  if(!empty($mainCount)){
    foreach($mainCount as $ert){
      $mainCitys = Cities::find()->where(['id' => $ert->cities_id])->one();
      echo $mainCitys->name;
    }
    
  }

?>
