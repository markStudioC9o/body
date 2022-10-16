<div class="row">
  
  <div class="col-md-12">
    <div class="input-group">
      <label for="">Положение кнопки</label>
      <select id="view-form-btn" class="form-control">
        <option value="view-left">
          Слева
        </option>
        <option value="view-center">
          По центру
        </option>
        <option value="view-right">
          Справа
        </option>
      </select>
    </div>
  </div>
  <? if(isset($data['output']) && !empty($data['output'])){
    $output = $data['output'];
  }else{
    $output = '';
  }?>
  <?= $this->render('../articles/param-margin', ['type' => 'btn-form', 'id' => '', 'output' => $output]) ?>
</div>
