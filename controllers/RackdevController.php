<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class RackdevController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        $session->open();
        if (isset($session['user'])) {
            return parent::beforeAction($action);
        } else {
            return $this->redirect(["main/login"]);
        }
    }

    public function actionIndex($id = -1)
    {
        $province_id = -1;
        $office_id = -1;
        $session = Yii::$app->session;
        $session->open();
        if(isset($session['user']))
        {
            $province_id = $session['user']['province_id'];
            $office_id = $session['user']['office_id'];
        }

        $rackdev = \app\models\ViewRackdevs::find()->where(['id'=>$id])->asArray()->one();
        if(!empty($rackdev))
        {
            if (($rackdev['province_id'] == $province_id) && ($rackdev['office_id'] == $office_id))
            {
                $exchange = \app\models\ViewExchanges::find()->where(['id' => $rackdev['exchange_id']])->asArray()->one();
                $device = \app\models\Devices::find()->where(['id' => $rackdev['device_id']])->asArray()->one();
                $dcp = \app\models\Devcp::find()->where(['device_id'=>$rackdev['device_id']])->asArray()->all();


                $this->layout = "simple";
                return $this->render('index', ['exchange'=>$exchange, 'rackdev'=>$rackdev, 'device'=>$device, 'dcp'=>$dcp]);
            }
        }

        return $this->redirect(["sitex/exchanges"]);
    }

}
