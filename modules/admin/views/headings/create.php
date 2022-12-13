<?

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
$this->title = 'Новая рубрика';
?>
<section class="col-lg-7 connectedSortable">
    <?= $this->render('_form',[
      'model' => $model
    ])?>
</section>