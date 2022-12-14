<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LanguageSetting */

$this->title = 'Update Language Setting: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Language Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="language-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
