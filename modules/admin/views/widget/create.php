<?php
use yii\helpers\Html;
?>
<div class="widget-create">
    <?= $this->render('_form', [
        'model' => $model,
        'lang' => $lang
    ]) ?>
</div>
