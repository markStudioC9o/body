<?php
use yii\helpers\Html;
?>
<div class="widget-create">
    <?= $this->render('_forms', [
        'model' => $model,
        'lang' => $lang
    ]) ?>
</div>
