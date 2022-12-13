<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->modules = [
          'filemanager' => [
              'class' => 'DeLuxis\Yii2SimpleFilemanager\SimpleFilemanagerModule',
              // 'as access' => [
              //     'class' => '\yii\filters\AccessControl',
              //     // 'rules' => [
              //     //     [
              //     //         'allow' => true,
              //     //         'roles' => ['@'],
              //     //     ],
              //     // ]
              // ]
          ]
      ];
    }
}
