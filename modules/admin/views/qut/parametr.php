<input type="hidden" value="<?= $data['id']?>">
<div class="row">
  <div class="col-md-12 mt-3">
    <strong>Параметры цитат</strong>
  </div>
  <div class="col-md-12 mt-3">
  <?= $this->render('/articles/param-margin', ['type' => 'qut', 'id' => $data['id'], 'output' => $data['output']]) ?>
    
  </div>
</div>