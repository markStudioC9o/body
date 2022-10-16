<?

use yii\widgets\Pjax;

?>
<h3>Уже используемые видео</h3>
<div class="block-place" style="background-color:#f5f5f5;width:100%;max-height:300px;overflow-y: visible;overflow-x: hidden;padding:5px">
  <? Pjax::begin([
    'id' => 'videoList'
  ]) ?>
  <div class="row">
    <? foreach ($array as $item) : ?>
      <div class="col-md-4 mt-1">
        <div class="row">
          <div class="col-md-12">
            <div class="video-dels" data-id="<?= $item['val'] ?>"><span class="fa fa-trash-o"></span></div>
          </div>
          <div class="col-md-12">
            <img class="video_alt" src="<?= $item['img'] ?>" alt="" style="width: 100%" data-id="<?= $item['id'] ?>">
            <div class="title_video">
              <?
              $file = "https://www.googleapis.com/youtube/v3/videos?id=" . $item['id'] . "&key=AIzaSyCEmhV8WOoINq7oUjeLQA-DSU6N9EQEDPk&part=snippet&fields=items(snippet(title))";
              $content = @file_get_contents($file, true);
              if ($content === false) {
              } else {
                $map = json_decode($content, true);
                if (isset($map['items'][0]['snippet']['title']) && !empty($map['items'][0]['snippet']['title'])) {
                  echo $map['items'][0]['snippet']['title'];
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    <? endforeach; ?>
  </div>
  <? Pjax::end(); ?>
</div>