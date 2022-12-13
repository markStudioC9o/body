<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<section class="params" style="background: #fff;">
    <div class="row">
        <?= $this->render('param-margin', ['type' => 'author', 'output' => $data['output']]) ?>
        <div class="col-md-12 mt-2">
            <label for="">Выбор автора</label>
            <?= Html::dropDownList('select_author', $selection = null, ArrayHelper::map($model, 'id', 'name'), ['prompt' => 'По Умолчанию', 'id' => 'selectAuthor', 'class' => 'form-control']) ?>
        </div>
            <?= $this->render('color-param',['type' => 'author']);?>
            <div class="col-md-12 mt-2">
              <label> Дата</label>
              <input type="text" id="dateAuthor"> 
            </div>
    </div>
</section>
<?= $this->registerJs('
    $( "#dateAuthor" ).datepicker({
      monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
      dateFormat: "dd MM yy",
      altField: ".data-param",
      altFormat: "dd MM yy"
    });
')?>