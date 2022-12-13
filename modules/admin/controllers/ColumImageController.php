<?php

namespace app\modules\admin\controllers;

use app\assets\AdminAsset;
use app\models\LanguageSetting;
use app\models\Widget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WidgetController implements the CRUD actions for Widget model.
 */
class ColumImageController extends MainController
{
    public $title;

    public function actionParamImage()
    {
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            return $this->renderAjax("param-image",[
                'id' => $data['id'],
                'data' => $data
            ]);
        }
    }
}
