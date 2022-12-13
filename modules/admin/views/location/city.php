<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="row">
    <div class="col-md-10">
        <div class="authors-index">
          <p>
          </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                      'attribute'=> 'name',
                      'format' => 'raw',
                      'value' => function($model){
                        return Html::a($model->name,['update', 'id' => $model->id]);
                      }
                    ],
                    // [
                    //   'attribute' => 'Переводы',
                    //   'format' => 'raw',
                    //   'value' => function($model){
                    //     $result = $model->lang;
                    //     if(!empty($result)){
                    //       $str = '<ul>';
                    //       foreach($result as $item){
                    //         $str .= '<li>'.$item->tag.' : '.$item->name.'</li>';
                    //       }
                    //       $str .= '<ul>';
                    //       return $str;
                    //     }else{
                    //       return null;
                    //     }
                    //   }
                    // ],
                      
                    [
                        'class' => ActionColumn::className(),
                        'template' => '<ul class="settingGrid"><li>'.'{delete}'.'</li></ul>',
                        'urlCreator' => function ($action , $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                    
                ],
            ]); ?>
        </div>
    </div>
</div>