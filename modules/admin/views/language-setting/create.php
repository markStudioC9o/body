<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Language Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">
        <div class="language-setting-create">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>