<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class ApisendController extends Controller
{

  public function actionIndex()
  {
    if (Yii::$app->request->isAjax) {
      $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : null;
      $data = Yii::$app->request->post();
      $text = 'Сообщение с виджета сайта'."\n"."\n";
      if(isset($data['form']) && !empty($data['form'])){
        foreach($data['form'] as $item){
          if($item['name'] == 'choise-city'){
            $text .= "Город: ". $item['value']."\n";
          }
          if($item['name'] == 'email'){
            $text .= "email: ". $item['value']."\n";
          }
          if($item['name'] == 'phone'){
            $text .= "Телефон: ". $item['value']."\n";
          }
          if($item['name'] == 'name'){
            $text .= "Имя: ". $item['value']."\n";
          }
          
        }
        if(!empty($lang)){
          $text .= "\nЯзык отправки:". $lang."\n"."\n";
        }
      }
      // $tg_user = '1270374546'; // id пользователя, для отправки сообщения
      // $bot_token = '5300055050:AAE9H1_PdGo6bHnBkYsQGF4PqVZdjctqWlo'; // токен бота
      // $text = "Первая строка сообщения со ссылкой \n Вторая строка с жирным текстом";
      // // параметры, которые отправятся в api телеграм
      // $params = array(
      //   'chat_id' => $tg_user, // id получателя
      //   'text' => $text, // текст сообщения
      //   'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
      // );

      // $curl = curl_init();
      // curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_token . '/sendMessage'); // адрес вызова api функции телеграм
      // curl_setopt($curl, CURLOPT_POST, true); // отправка методом POST
      // curl_setopt($curl, CURLOPT_TIMEOUT, 10); // время выполнения запроса
      // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      // curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // параметры запроса
      // $result = curl_exec($curl); // запрос к api
      // curl_close($curl);
      // var_dump(json_decode($result));
      $idList = array("1270374546","385322204","865607635");
      if(!empty($text)){
        foreach($idList as $item => $val){
          $this->send($val, $text);
        }
      }
    }
  }

  public function send($tg_user, $text){
      $bot_token = '5300055050:AAE9H1_PdGo6bHnBkYsQGF4PqVZdjctqWlo';
      $params = array(
        'chat_id' => $tg_user,
        'text' => $text,
        'parse_mode' => 'HTML',
      );
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_token . '/sendMessage');
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_TIMEOUT, 10);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
      $result = curl_exec($curl);
      curl_close($curl);
      var_dump(json_decode($result));
  }
}
