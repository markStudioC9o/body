<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */

$this->title = 'Create Authors';
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">
        <div class="authors-create">
            <?= $this->render('_form', [
                'model' => $model,
                'lang' => $lang,
            ]) ?>
        </div>
    </div>
</div>