
<?
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;
mihaildev\elfinder\Assets::noConflict($this);

echo InputFile::widget([
    'language'   => 'ru',
    'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
    'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории  
    'filter'     => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
    'name'       => 'myinput',
    'value'      => '',
]);

// echo $form->field($model, 'attribute')->widget(InputFile::className(), [
//     'language'      => 'ru',
//     'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
//     'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории 
//     'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
//     'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
//     'options'       => ['class' => 'form-control'],
//     'buttonOptions' => ['class' => 'btn btn-default'],
//     'multiple'      => false       // возможность выбора нескольких файлов
// ]);
?>
<section class="fgh" style="height:80vh">
<?
echo ElFinder::widget([
    'language'         => 'ru',
    'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
    'filter'           => array('image', 'video/mp4'),    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
    'callbackFunction' => new JsExpression('function(file, id){}'), // id - id виджета
    // 'uploadAllow'   => array('image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/x-icon', 'text/plain', ),
]);
?>
</section>
    

<style>
  .fgh div{
    height: 100%;
  }
</style>
