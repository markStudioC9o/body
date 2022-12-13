    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12 mb-3">
          <a class="btn btn-primary float-left" href="/admin/headings/create"><i class="fas fa-plus"></i> Новая рубрика</a>
        </div>
        <div class="col-md-12">
          <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo Yii::$app->session->getFlash('success'); ?>
            </div>
          <?php endif; ?>
        </div>
        <section class="col-lg-5 connectedSortable">
          <div class="row">
            <div class="col-md-12">
              <div class="tree_rub">
                <?= $tree ?>
              </div>
            </div>
          </div>
        </section>
        <section class="col-lg-7 connectedSortable">
          <div class="row">
            <div class="col-md-12">
              <? if (!empty($lang)) : ?>
                <div id="data-rub">
                  <ul>
                    <? foreach ($lang as $elem) : ?>
                      <li><a href="#tabs-<?= $elem->id?>"><?= $elem->name?></a></li>
                    <? endforeach; ?>
                  </ul>
                  <?= $this->render('_form_lang',[
                    'lang' => $lang,
                    'model' => $model,
                    'list' => $list
                  ])?>
                </div>
              <? endif ?>
              <!-- <div id=""> -->
                <?//= $this->render('_form', [
                  //'model' => $model
                //]) ?>
              <!-- </div> -->
            </div>
          </div>
        </section>
      </div>
    </div>
    <? if (!empty($id)) : ?>
      <? $this->registerJs("
      getHeading(" . $id . ");
      ") ?>

    <? endif; ?>
    <? $this->registerJs("
  $('.list-trab').on('click', function(e){

    var id = $(this).data('id');
    getHeading(id);
  })

  function getHeading(id){
    $.post('/admin/headings/heading-update', {id: id}, Success);
    function Success(data){
      $('.list-trab').removeClass('active');
      $('.list-olf-'+id).addClass('active');
      if(data){
        $('#data-rub').html(data);
      }
    }
  }
  $('#data-rub').tabs({
    active: 0
  });
 "); ?>