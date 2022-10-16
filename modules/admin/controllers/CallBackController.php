<?php


namespace app\modules\admin\controllers;

use app\models\CallbacField;
use app\models\CallbacFieldLang;
use app\models\CallbackParam;
use app\models\CallbackParamLang;
use app\models\CallbacOption;
use app\models\CallbacWidget;
use app\models\CallbacWidgetLang;
use app\models\CillbacOptionLang;
use app\models\LanguageSetting;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class CallBackController extends MainController
{
  public $title = 'Настройки виджета';

  public $con = array(
    'in' => array(
      'img' => '/vidget/iocn/in.svg',
      'link' => ''
    ),
    'wh' => array(
      'img' => '/vidget/iocn/wh.svg',
      'link' => ''
    ),
    'em' => array(
      'img' => '/vidget/iocn/em.svg',
      'link' => ''
    ),
    'fb' => array(
      'img' => '/vidget/iocn/fb.svg',
      'link' => ''
    ),
    'tg' => array(
      'img' => '/vidget/iocn/tg.svg',
      'link' => ''
    ),
    'vb' => array(
      'img' => '/vidget/iocn/vb.svg',
      'link' => '',
    ),
    'vk' => array(
      'img' => '/vidget/iocn/vc.svg',
      'link' => ''
    )
  );

  public function actionIndex($tag = null)
  {
    $lang = LanguageSetting::find()->all();

    if (!empty($tag) && $tag != 'ru') {
      return $this->redirect(['call-back-lang', 'tag' => $tag]);
    } else {
      $array = CallbacOption::find()->where(['param' => 'con'])->asArray()->one();
      $firTit =  CallbacOption::find()->where(['param' => 'fir-tit'])->one();
      $stepTit =  CallbacOption::find()->where(['param' => 'step-tit'])->one();
      $parls =  CallbacOption::find()->where(['param' => 'parls'])->one();
      $link1 =  CallbacOption::find()->where(['param' => 'link_1'])->one();
      $link2 =  CallbacOption::find()->where(['param' => 'link_2'])->one();
      $button =  CallbacOption::find()->where(['param' => 'button'])->one();
      $text =  CallbacOption::find()->where(['param' => 'text'])->one();
      $name =  CallbacOption::find()->where(['param' => 'name'])->one();
    }

    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      
      if (isset($data['con']) && !empty($data['con'])) {
        if (CallbacOption::find()->where(['param' => 'con'])->exists()) {
          $con = CallbacOption::find()->where(['param' => 'con'])->one();
          $con->value = json_encode($data['con']);
        } else {
          $con = new CallbacOption([
            'param' => 'con',
            'value' => json_encode($data['con'])
          ]);
        }
        if (!$con->save()) {
          return var_dump($con->getErrors());
        }
      }

      if (isset($data['param']) && !empty($data['param'])) {
        if (!empty($data['param']['firTit'])) {
          $firTit->value = $data['param']['firTit'];
          if (!$firTit->save()) {
            return var_dump($firTit->getErrors());
          }
        }

        if (!empty($data['param']['name'])) {
          $name->value = $data['param']['name'];
          if (!$name->save()) {
            return var_dump($name->getErrors());
          }
        }


        if (!empty($data['param']['text'])) {
          $text->value = $data['param']['text'];
          if (!$text->save()) {
            return var_dump($text->getErrors());
          }
        }
        if (!empty($data['param']['button'])) {
          $button->value = $data['param']['button'];
          if (!$button->save()) {
            return var_dump($button->getErrors());
          }
        }

        if (!empty($data['param']['stepTit'])) {
          $stepTit->value = $data['param']['stepTit'];
          if (!$stepTit->save()) {
            return var_dump($stepTit->getErrors());
          }
        }
        if (!empty($data['param']['parls'])) {
          $parls->value = $data['param']['parls'];
          if (!$parls->save()) {
            return var_dump($parls->getErrors());
          }
        }
        if (!empty($data['param']['link1'])) {
          $link1->value = json_encode($data['param']['link1']);
          if (!$link1->save()) {
            return var_dump($link1->getErrors());
          }
        }
        if (!empty($data['param']['link2'])) {
          $link2->value = json_encode($data['param']['link2']);
          if (!$link2->save()) {
            return var_dump($link2->getErrors());
          }
        }
      }
      return $this->refresh();
    }
    return $this->render('index', [
      'tag' => $tag,
      'lang' => $lang,
      'array' => json_decode($array['value'], true),
      'firTit' => $firTit->value,
      'stepTit' => $stepTit->value,
      'link2' =>  json_decode($link2->value, true),
      'parls' =>  $parls->value,
      'link1' =>  json_decode($link1->value, true),
      'button' => $button,
      'text' => $text,
      'name' => $name
    ]);
  }


  public function actionWidgetOne($id, $tag = null)
  {
    $lang = LanguageSetting::find()->all();
    if (empty($tag) || $tag == 'ru') {
      $widget = CallbacWidget::findOne($id);
    } else {
      if (CallbacWidgetLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $tag])->exists()) {
        $widget = CallbacWidgetLang::find()->where(['parent_id' => $id])->andWhere(['tag' => $tag])->one();
      } else {
        $widget = new CallbacWidgetLang();
        $widget->tag = $tag;
        $widget->parent_id = $id;
      }
    }
    if (empty($tag) || $tag == 'ru') {
      $field = CallbacField::find()->where(['widget_1' => $id])->all();
    } else {
      if (CallbacFieldLang::find()->where(['widget_1' => $id])->andWhere(['tag' => $tag])->exists()) {
        $field = CallbacFieldLang::find()->where(['widget_1' => $id])->andWhere(['tag' => $tag])->all();
      } else {
        $field = CallbacField::find()->where(['widget_1' => $id])->all();
      }
    }
    if (Yii::$app->request->isPost) {
      $data = Yii::$app->request->post();
      $istanse = UploadedFile::getInstanceByName('callbackimg');
      if (!empty($istanse)) {
        if (CallbackParam::find()->where(['param' => 'img'])->andwhere(['widget_id' => $id])->exists()) {
          $imgCall = CallbackParam::find()->where(['param' => 'img'])->andwhere(['widget_id' => $id])->one();
          $imgCall->image = $istanse;
          $imgCall->value = $imgCall->upload();
        } else {
          $imgCall = new CallbackParam([
            'widget_id' => $id,
            'param' => 'img',

          ]);
          $imgCall->image = $istanse;
          $imgCall->value = $imgCall->upload();
        }
        if (!$imgCall->save(false)) {
          var_dump($imgCall->getErrors());
        }
      }

      if (isset($data['CallbacWidget']) && !empty($data['CallbacWidget'])) {
        $widget->name = $data['CallbacWidget']['name'];
        $widget->active = $data['CallbacWidget']['active'];
        if (!$widget->save()) {
          var_dump($widget->getErrors());
        }
      }

      if (isset($data['CallbacWidgetLang']) && !empty($data['CallbacWidgetLang'])) {
        $widget->name = $data['CallbacWidgetLang']['name'];
        $widget->active = $data['CallbacWidgetLang']['active'];
        if (!$widget->save()) {
          var_dump($widget->getErrors());
        }
      }


      if (isset($data['callBackField']) && !empty($data['callBackField'])) {
        if (empty($tag) || $tag == 'ru') {
          $this->saveFieldDefault($data['callBackField'], $id);
        } else {
          $this->saveFieldLang($data['callBackField'], $id, $tag);
        }

        if (isset($data['param']) && !empty($data['param'])) {
          if (empty($tag) || $tag == 'ru') {
            if (CallbackParam::find()->where(['widget_id' => $id])->andWhere(['param' => 'link'])->exists()) {
              $linkS = CallbackParam::find()->where(['widget_id' => $id])->andWhere(['param' => 'link'])->one();
            } else {
              $linkS = new CallbackParam();
            }
          } else {
            if (CallbackParamLang::find()->where(['widget_id' => $id])->andWhere(['param' => 'link'])->andWhere(['tag' => $tag])->exists()) {
              $linkS = CallbackParamLang::find()->where(['widget_id' => $id])->andWhere(['param' => 'link'])->andWhere(['tag' => $tag])->one();
            } else {
              $linkS = new CallbackParamLang();
              $linkS->tag = $tag;
            }
          }
          $linkS->param = 'link';
          $linkS->value = json_encode($data['param'], true);
          $linkS->widget_id = $id;
          if (!$linkS->save()) {
            var_dump($linkS->getErrors());
          }
        }

        if (isset($data['pos_linker']) && !empty($data['pos_linker'])) {
          if (empty($tag) || $tag == 'ru') {
            if (CallbackParam::find()->where(['widget_id' => $id])->andWhere(['param' => 'pos_linker'])->exists()) {
              $linkP = CallbackParam::find()->where(['widget_id' => $id])->andWhere(['param' => 'pos_linker'])->one();
            } else {
              $linkP = new CallbackParam();
            }
          } else {
            if (CallbackParamLang::find()->where(['widget_id' => $id])->andWhere(['param' => 'pos_linker'])->andWhere(['tag' => $tag])->exists()) {
              $linkP = CallbackParamLang::find()->where(['widget_id' => $id])->andWhere(['param' => 'pos_linker'])->andWhere(['tag' => $tag])->one();
            } else {
              $linkP = new CallbackParamLang();
              $linkP->tag = $tag;
              $linkP->widget_id = $id;
              $linkP->param = 'pos_linker';
            }
          }
          $linkP->value = $data['pos_linker'];

          if (!$linkP->save()) {
            var_dump($linkP->getErrors());
          }
        }
      }
      return $this->refresh();
    }
    if (empty($tag) || $tag == 'ru') {
      $linker = CallbackParam::find()->where(['widget_id' => $id])->andWhere(['param' => 'link'])->asArray()->one();
      $posLinker = CallbackParam::find()->where(['widget_id' => $id])->andWhere(['param' => 'pos_linker'])->asArray()->one();
    } else {
      $linker = CallbackParamLang::find()->where(['widget_id' => $id])->andWhere(['param' => 'link'])->andWhere(['tag' => $tag])->asArray()->one();
      $posLinker = CallbackParamLang::find()->where(['widget_id' => $id])->andWhere(['param' => 'pos_linker'])->andWhere(['tag' => $tag])->asArray()->one();
    }

    if (!empty($linker)) {
      $leg = json_decode($linker['value'], true);
    } else {
      $leg = null;
    }

    if (!empty($posLinker)) {
      $posPos = $posLinker['value'];
    } else {
      $posPos = null;
    }
    return $this->render('update', [
      'id' => $id,
      'widget' => $widget,
      'field' => $field,
      'leg' => $leg,
      'posPos' => $posPos,
      'lang' => $lang,
      'tag' => $tag
    ]);
  }

  public function saveFieldDefault($data, $id)
  {
    //$data['callBackField']
    foreach ($data as $el => $it) {
      if (CallbacField::find()->where(['id' => $el])->exists()) {
        $model = CallbacField::find()->where(['id' => $el])->one();
        if (isset($it['active'])) {
          $model->active = $it['active'];
        }else{
          $model->active = '0';
        }
        if (isset($it['reqared'])) {
          $model->reqared = $it['reqared'];
        }else{
          $model->reqared = '0';
        }
        
        if (isset($it['name'])) {
          $model->name = $it['name'];
        }
        $model->widget_1 = $id;
        if (!$model->save()) {
          return var_dump($model->getErrors());
        }
      }
    }
  }

  public function saveFieldLang($data, $id, $tag)
  {
    foreach ($data as $el => $it) {
      if (CallbacFieldLang::find()->where(['id' => $el])->exists()) {
        $model = CallbacFieldLang::find()->where(['id' => $el])->one();
      } else {
        $model = new CallbacFieldLang();
        if (isset($it['value'])) {
          $model->value = $it['value'];
        }
      }
      $model->tag = $tag;
      if (isset($it['active'])) {
        $model->active = $it['active'];
      }else{
        $model->active = '0';
      }
      if (isset($it['reqared'])) {
        $model->reqared = $it['reqared'];
      }else{
        $model->active = '0';
      }
      if (isset($it['name'])) {
        $model->name = $it['name'];
      }

      $model->widget_1 = $id;
      if (!$model->save()) {
        return var_dump($model->getErrors());
      }
    }
  }

  public function actionCallBackLang($tag)
  {
    $arrayVal = $this->con;
    $firTitVal = null;
    $stepTitVal = null;
    $link1Val = array('name' => '', 'url' => '');
    $link2Val = array('name' => '', 'url' => '');
    $parlsVal = null;
    $batnVal = null;
    $textVal = null;
    $nameVal =null;
    $lang = LanguageSetting::find()->all();

    $button =  CillbacOptionLang::find()->where(['param' => 'button'])->andWhere(['tag' => $tag])->one();
    if (!empty($button->value)) {
      $batnVal = $button->value;
    }
    $text =  CillbacOptionLang::find()->where(['param' => 'text'])->andWhere(['tag' => $tag])->one();
    if (!empty($text->value)) {
      $textVal = $text->value;
    }

    $name =  CillbacOptionLang::find()->where(['param' => 'name'])->andWhere(['tag' => $tag])->one();
    if (!empty($name->value)) {
      $nameVal = $name->value;
    }


    $array = CillbacOptionLang::find()->where(['param' => 'con'])->andWhere(['tag' => $tag])->asArray()->one();
    if (!empty($array['value'])) {
      $arrayVal = json_decode($array['value'], true);
    }

    $firTit =  CillbacOptionLang::find()->where(['param' => 'fir-tit'])->andWhere(['tag' => $tag])->one();
    if (!empty($firTit->value)) {
      $firTitVal = $firTit->value;
    }

    $stepTit =  CillbacOptionLang::find()->where(['param' => 'step-tit'])->andWhere(['tag' => $tag])->one();
    if (!empty($stepTit->value)) {
      $stepTitVal = $stepTit->value;
    }

    $parls =  CillbacOptionLang::find()->where(['param' => 'parls'])->andWhere(['tag' => $tag])->one();
    if (!empty($parls->value)) {
      $parlsVal = $parls->value;
    }
    $link1 =  CillbacOptionLang::find()->where(['param' => 'link_1'])->andWhere(['tag' => $tag])->one();
    if (!empty($link1->value)) {
      $link1Val = json_decode($link1->value, true);
    }
    $link2 =  CillbacOptionLang::find()->where(['param' => 'link_2'])->andWhere(['tag' => $tag])->one();
    if (!empty($link2->value)) {
      $link2Val = json_decode($link2->value, true);
    }
    if ($this->request->isPost) {
      $data = $this->request->post();
      if (isset($data['con']) && !empty($data['con'])) {
        if (CillbacOptionLang::find()->where(['param' => 'con'])->andWhere(['tag' => $tag])->exists()) {
          $con = CillbacOptionLang::find()->where(['param' => 'con'])->andWhere(['tag' => $tag])->one();
          $con->value = json_encode($data['con']);
        } else {
          $con = new CillbacOptionLang([
            'param' => 'con',
            'value' => json_encode($data['con']),
            'parent_id' => '1',
            'tag' => $tag,
          ]);
        }
        if (!$con->save()) {
          return var_dump($con->getErrors());
        }
      }

      if (isset($data['param']) && !empty($data['param'])) {
        foreach ($data['param'] as $item => $elem) {
          if (is_array($elem)) {
            $value = json_encode($elem);
          } else {
            $value = $elem;
          }
          if (CillbacOptionLang::find()->where(['param' => $item])->andWhere(['tag' => $tag])->exists()) {
            $paramSave = CillbacOptionLang::find()->where(['param' => $item])->andWhere(['tag' => $tag])->one();
            $paramSave->value = $value;
          } else {
            $paramSave = new CillbacOptionLang([
              'param' => $item,
              'value' => $value,
              'parent_id' => '1',
              'tag' => $tag
            ]);
          }
          if (!$paramSave->save()) {
            var_dump($paramSave->getErrors());
          }
        }
      }
      return $this->refresh();
    }
    return $this->render('update-ser', [
      'tag' => $tag,
      'lang' => $lang,
      'array' => $arrayVal,
      'firTit' => $firTitVal,
      'stepTit' => $stepTitVal,
      'link2' =>  $link1Val,
      'parls' =>  $parlsVal,
      'link1' => $link2Val,
      'button' => $batnVal,
      'text' => $textVal,
      'nameVal' => $nameVal
    ]);
  }
}
