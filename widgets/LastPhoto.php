<?
namespace app\widgets;

use app\models\FormBilder;
use yii\base\Widget;


class LastPhoto extends Widget {

    public $id = null; // this parameter will be overwritten by 8 

    public function run() {
        $model = FormBilder::findOne($this->id);
        return $model->value;
    }

}

?>