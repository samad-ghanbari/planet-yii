<?php
namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;

class DeviceWidget extends Widget{
    public $device, $dcp;
    public function init()
    {
        $count=0;
        parent::init();
    }
    public function run()
    {
        return $this->render("DeviceView", ["device"=>$this->device, "dcp"=>$this->dcp]);
    }
}
?>
