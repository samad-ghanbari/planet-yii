<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use app\components\GeneralMethods;
class RackController extends \yii\web\Controller
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
        $this->layout = "simple";
        // check authority
        //get rack area-exch-site-type
        $session = Yii::$app->session;
        $session->open();
        $province_id = -1;
        $office_id = -1;
        if(isset($session['user']))
        {
            $province_id = $session['user']['province_id'];
            $office_id = $session['user']['office_id'];
        }

        $rack = \app\models\ViewRacks::find()->where(['id'=>$id])->asArray()->one();
        if(!empty($rack))
        {
            if( ($rack['province_id'] == $province_id) && ($rack['office_id'] == $office_id) )
            {
                $exchange = \app\models\ViewExchanges::find()->where(['id'=>$rack['exchange_id']])->asArray()->one();
                $rackDevs = \app\models\ViewRackdevs::find()->where(['rack_id'=>$id])->asArray()->all();
                //$saloon = \app\models\ViewRacks::find()->select('saloon_id','saloon')->where(['id'=>$id])->asArray()->one();
                //$saloons = \app\models\ViewSaloons::find()->select('id,saloon')->where(['province_id'=>$province_id, 'office_id'=>$office_id, 'exchange_id'=>$exchange['id']])->asArray([])->all();
                $racks = \app\models\ViewRacks::find()->select('id,saloon,rack_row, rack_column')->where(['province_id'=>$province_id, 'office_id'=>$office_id, 'exchange_id'=>$exchange['id']])->orderBy('saloon, rack_row, rack_column')->asArray()->all();
                $purchases0 = \app\models\Purchases::find()->select("id,abbr,purchase")->where(['province_id'=>$province_id, 'office_id'=>$office_id])->orderBy('abbr')->asArray()->all();
                $devices0 = \app\models\Devices::find()->select("id, device, type")->orderBy('type, device')->where(['province_id'=>$province_id, 'office_id'=>$office_id])->asArray()->all();
                $devices = [];
                $purchases = [];
                foreach ($devices0 as $dev)
                {
                    array_push($devices,['id'=>$dev['id'], 'type'=>$dev['type'], 'device'=>$dev['device']]);
                }
                foreach ($purchases0 as $pur)
                {
                    array_push($purchases,['abbr'=>$pur['abbr'], 'purchase'=>$pur['purchase']]);
                }

                return $this->render('index', ['id'=>$id, 'exchange'=>$exchange, 'rack'=>$rack, 'racks'=>$racks, 'rackDevs'=>$rackDevs, 'devices'=>$devices, 'purchases'=>$purchases ]);
            }
            else
                return $this->redirect(["main/login"]);
        }
        else
            return $this->redirect(["main/login"]);
    }

    public function actionAdd_new_device()
    {
        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post()['rackdev'];
            $session = Yii::$app->session;
            $session->open();
            if($session['user'])
            {
                $province_id = $session['user']['province_id'];
                $office_id = $session['user']['office_id'];

                $rack_id = $post['id'];
                $shelf = $post['shelf'];
                $device_id = $post['device'];
                $purchase = $post['purchase'];
                $desc = $post['desc'];

                $rack = \app\models\ViewRacks::find()->where(['id'=>$rack_id])->asArray()->one();
                if( ($rack['province_id'] == $province_id) && ($rack['office_id'] == $rack_id) )
                {
                    $exch = \app\models\ViewExchanges::find()->where(['id'=>$rack['exchange_id']])->asArray()->one();
                    $device = \app\models\Devices::find()->select('device')->where(['id'=>$device_id])->scalar();

                    $row = $rack['rack_row'];
                    $column = $rack['rack_column'];
                    $abbr = $exch['abbr'];
                    if($exch['type'] == 3)
                    {
                        $abbr = $exch['mother_abbr'].'-'.$abbr;
                    }
                    $device_name = GeneralMethods::create_device_name($exch['area'],$abbr,$row,$column,$shelf,$device);

                    $model = new \app\models\Rackdevs();
                    $model->rack_id = $rack_id;
                    $model->device_id = $device_id;
                    $model->shelf_no = $shelf;
                    $model->device_name = $device_name;
                    $model->purchase = $purchase;
                    $model->description = $desc;

                    try
                    {
                        $model->save();
                        Yii::$app->session->setFlash("success", "The device was successfully installed.");
                    }
                    catch (\Exception $e)
                    {
                        Yii::$app->session->setFlash("error", "problem was occurred while device installation. check the shelf Number.");
                    }

                    return $this->redirect(['rack/index', 'id'=>$rack_id]);
                }
            }
        }
        return $this->redirect(['sitex/exchange']);
    }

    public function actionRemove_device()
    {
        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post()['rackdev'];
            $session = Yii::$app->session;
            $session->open();
            if($session['user'])
            {
                $province_id = $session['user']['province_id'];
                $office_id = $session['user']['office_id'];

                $rackdev_id = $post['id'];
                $model = \app\models\ViewRackdevs::find()->where(['id'=>$rackdev_id])->asArray()->one();

                if( ($province_id == $model['province_id']) && ($office_id == $model['office_id']) )
                {
                    $model = \app\models\Rackdevs::find()->where(['id'=>$rackdev_id])->one();
                    try
                    {
                        $model->delete();
                        Yii::$app->session->setFlash('success','The device was successfully removed.');
                    }
                    catch(\Exception $e)
                    {
                        Yii::$app->session->setFlash('error','There was an error while removing the device. Check that the device is empty or not.');
                    }

                    return $this->redirect(['rack/index', 'id'=>$model['rack_id']]);
                }
            }
        }

        return $this->redirect(['sitex/exchange']);
    }

    public function actionEdit_device()
    {
        if(Yii::$app->request->isPost)
        {
            $session = Yii::$app->session;
            $session->open();
            if($session['user'])
            {
                $province_id = $session['user']['province_id'];
                $office_id = $session['user']['office_id'];

                $post = Yii::$app->request->post()['rackdev'];
                $rackdev_id = $post['id'];
                $model = \app\models\ViewRackdevs::find()->where(['id' => $rackdev_id])->one();

                if (($province_id == $model->province_id) && ($office_id == $model->office_id))
                {
                    $model = \app\models\Rackdevs::find()->where(['id' => $rackdev_id])->one();
                    $current['device_id'] = $model->device_id;
                    $current['rack_id'] = $model->rack_id;
                    $current['purchase'] = $model->purchase;
                    $current['shelf_no'] = $model->shelf_no;

                    $rack_id = $post['rack'];
                    $shelf = $post['shelf'];
                    $device_id = $post['device'];
                    $purchase = $post['purchase'];
                    $desc = $post['desc'];

                    $model->rack_id = $rack_id;
                    $model->shelf_no = $shelf;
                    $model->device_id = $device_id;
                    $model->purchase = $purchase;
                    $model->description = $desc;


                    if( ($rack_id != $current['rack_id']) || ($shelf != $current['shelf_no']) || ($device_id != $current['device_id']) )
                    {
                        //update device name
                        $RACK = \app\models\ViewRacks::find()->where(['id'=>$rack_id])->asArray()->one();
                        $AREA = $RACK['area'];
                        $ABBR = $RACK['abbr'];
                        $ROW = $RACK['rack_row'];
                        $COL = $RACK['rack_column'];
                        $SHELF = $shelf;
                        $DEV  = \app\models\Devices::find()->select('device')->where(['id'=>$device_id])->scalar();
                        $devname = \app\components\GeneralMethods::create_device_name($AREA,$ABBR,$ROW,$COL,$SHELF,$DEV);
                        $model->device_name = $devname;

                        //update interfaces
                        //update odf
                        //update dslam
                    }

                    try
                    {
                        if($model->update())
                            Yii::$app->session->setFlash('success', 'The modification has been successfully done');
                        else
                        {
                            Yii::$app->session->setFlash('error', 'There was an error while modification. Check the shelf Number.');
                            return $this->redirect(['rack/index', 'id' => $current['rack_id']]);
                        }
                    }
                    catch (\Exception $e)
                    {
                        Yii::$app->session->setFlash('error', 'There was an error while modification.');
                        return $this->redirect(['rack/index', 'id'=>$current['rack_id']]);
                    }
                }
            }
            else
            {
                Yii::$app->session->setFlash('error', 'You do not have the modification authority.');
            }
        }

        return $this->redirect(['rack/index', 'id'=>$rack_id]);
    }



}
