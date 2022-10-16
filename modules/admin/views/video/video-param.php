<div class="row">
  <div class="col-md-12">
    <input type="text" value="<?= $data['id']?>" id="videoId">
  </div>
  <div class="col-md-12">
    <input type="text" value="<?= $data['blockId']?>" id="blockId">
  </div>
  <div class="col-md-12">
    <label for="">
    <input type="checkbox" value="1" id="open-modal-in-video" <?= (isset($data["chek"]) && !empty($data["chek"]) ? "checked" : "")?>> Открывать в окне</label>
    
  </div>
</div>