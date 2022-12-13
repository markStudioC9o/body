<?

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="col-md-12">
    <? $form = ActiveForm::begin(); ?>
    <input type="hidden" value="<?= $model['id']?>" name="Heading[id]">
    <div class="form-group field-heading-title">
        <label class="control-label" for="heading-title">Название</label>
        <input type="text" id="heading-title" class="form-control" name="Heading[title]" value="<?= $model['title'] ?>">
    </div>
    <div class="form-group field-heading-descript">
        <label class="control-label" for="heading-descript">Descript (SEO)</label>
        <input type="text" id="heading-descript" class="form-control" name="Heading[descript]" value="<?= $model['descript'] ?>">
    </div>
    <div class="form-group field-heading-key_meta">
        <label class="control-label" for="heading-key_meta">Key Meta (SEO)</label>
        <input type="text" id="heading-key_meta" class="form-control" name="Heading[key_meta]" value="<?= $model['key_meta'] ?>">
    </div>
    <div class="form-group field-heading-key_meta">
        <label class="control-label" for="heading-key_meta">Внешний вид</label>
        <?
        $items = array(
          '1' => '1 колонкa',
          '2' => '2 колонки',
          '3' => '4 колонки'
        );
        ?>
        <?= Html::dropDownList('Heading[col]', $model['col'], $items, ['class' => 'form-control']);?>
    </div>
    <?
        echo \vova07\imperavi\Widget::widget([
            'id' => 'heading-text',
            'name' => 'Heading[text]',
            'value' => $model['text'],
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    //'clips',
                    //'fullscreen',
                ]
                // 'clips' => [
                //     ['red', '<span class="label-red">red</span>'],
                //     ['green', '<span class="label-green">green</span>'],
                //     ['blue', '<span class="label-blue">blue</span>'],
                // ],
            ],
        ]);
        ?>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Соханить</button>
    </div>
    <? ActiveForm::end(); ?>
</div>