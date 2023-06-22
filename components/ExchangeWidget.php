<?php
namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;

class ExchangeWidget extends Widget{
    public $model;
    public function init()
    {
        $count=0;
        parent::init();
    }
    public function run()
    {
        return $this->render("ExchangeView", ["model"=>$this->model]);
    }
}
?>
