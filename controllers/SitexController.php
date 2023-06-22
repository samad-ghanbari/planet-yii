<?php

namespace app\controllers;

use app\models\Exchanges;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class SitexController extends \yii\web\Controller
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

    public function actionExchanges($area = -1)
    {
        $session = Yii::$app->session;
        $session->open();
        $province = -1;
        $office = -1;
        if (isset($session['user'])) {
            $province = $session['user']['province_id'];
            $office = $session['user']['office_id'];
        }

        if ($area == -1) {
            if (isset($session['area'])) $area = $session['area'];
        } else {
            if (isset($session['area'])) $session->remove('area');
            $session['area'] = $area;
        }

        $exchanges = \app\models\ViewExchanges::find()->where(['province_id' => $province, 'office_id' => $office, 'area' => $area, 'type_no' => 2])->asArray()->all();
        $this->layout = "simple";
        return $this->render("exchanges", ['exchangesModel' => $exchanges, 'area' => $area]);
    }

    public function actionExchange($id = -1)
    {
        $session = Yii::$app->session;
        $session->open();
        if ($id == -1) {
            if (isset($session['exchange']['id'])) {
                $id = $session['exchange']['id'];
            }
        }

        if (($id > -1) && (isset($session['user']))) {
            $viewSaloons = \app\models\ViewSaloons::find()->where(['province_id' => $session['user']['province_id'], 'office_id' => $session['user']['office_id'], 'exchange_id' => $id])->orderBy(['floor' => SORT_DESC])->asArray()->all();
            $viewRacks = \app\models\ViewRacks::find()->where(['province_id' => $session['user']['province_id'], 'office_id' => $session['user']['office_id'], 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC, 'rack_row' => SORT_ASC, 'rack_column' => SORT_ASC])->asArray()->all();
            $viewOdfs = \app\models\ViewOdfs::find()->where(['province_id' => $session['user']['province_id'], 'office_id' => $session['user']['office_id'], 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC, 'odf_no' => SORT_ASC, 'odf_row' => SORT_ASC, 'odf_column' => SORT_ASC])->asArray()->all();
            $viewRackDevs = \app\models\ViewRackdevs::find()->where(['province_id' => $session['user']['province_id'], 'office_id' => $session['user']['office_id'], 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC, 'rack_id' => SORT_ASC, 'rack_row' => SORT_ASC, 'rack_column' => SORT_ASC, 'shelf_no' => SORT_ASC])->asArray()->all();
            $objects = \app\models\ViewObjects::find()->where(['province_id' => $session['user']['province_id'], 'office_id' => $session['user']['office_id'], 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC])->asArray()->all();
            $objects_template = \app\models\ViewExchangeObjectTemplate::find()->where(['province_id' => $session['user']['province_id'], 'office_id' => $session['user']['office_id'], 'exchange_id' => $id])->asArray()->all();
            $definedObjects = \app\models\ObjectsTemplate::find()->select(['id', 'object_name', 'object_icon'])->asArray()->all();
            $objectsTemplate = [];
            foreach ($objects_template as $ot) {
                $objectsTemplate[$ot['object_template_id']] = ['id' => $ot['object_template_id'], 'name' => $ot['object_name'], 'icon' => $ot['object_icon'], 'template' => $ot['object_template']];
            }
            if (isset($session['exchange'])) $session->remove('exchange');
            $exch = \app\models\Exchanges::find()->where(['id'=>$id])->asArray()->one();
            $session['exchange'] = $exch;

            $this->layout = "simple";
            return $this->render("saloons", ['viewSaloons' => $viewSaloons, 'viewRacks' => $viewRacks, 'viewOdfs' => $viewOdfs, 'viewRackDevs' => $viewRackDevs, 'objects' => $objects, 'objectsTemplate' => $objectsTemplate, 'definedObjects' => $definedObjects]);
        }

        return $this->redirect(["main/provinces"]);
    }

    //rearrange
    public function actionRearrange_rack()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $rackId = $post['id'];
                $top = $post['top'];
                $left = $post['left'];

                $model = \app\models\Racks::find()->where(['id' => $rackId])->one();
                $rackWidth = $model->rack_width;
                $rachHeight = $model->rack_height;

                $saloon = \app\models\Saloons::find()->where(['id' => $model->saloon_id])->one();
                $saloonWidth = $saloon->saloon_width * 100;
                $saloonHeight = $saloon->saloon_height * 100;

                if ($top > ($saloonHeight - $rachHeight))  $top = $saloonHeight - $rachHeight;
                if ($left > ($saloonWidth - $rackWidth)) $left = $saloonWidth - $rackWidth;
                if ($top < -30) $top = -30;
                if ($left < -30) $left = -30;
                $model->rack_top = $top;
                $model->rack_left = $left;

                if ($model->update())
                    return true;
                else
                    return false;
            }
        }
    }

    public function actionRearrange_odf()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $odfId = $post['id'];
                $top = $post['top'];
                $left = $post['left'];

                $model = \app\models\Odfs::find()->where(['id' => $odfId])->one();
                $odfWidth = $model->odf_width;
                $odfHeight = $model->odf_height;

                $saloon = \app\models\Saloons::find()->where(['id' => $model->saloon_id])->one();
                $saloonWidth = $saloon->saloon_width * 100;
                $saloonHeight = $saloon->saloon_height * 100;

                if ($top > ($saloonHeight - $odfHeight))  $top = $saloonHeight - $odfHeight;
                if ($left > ($saloonWidth - $odfWidth)) $left = $saloonWidth - $odfWidth;
                if ($top < -30) $top = -30;
                if ($left < -30) $left = -30;
                $model->odf_top = $top;
                $model->odf_left = $left;

                if ($model->update())
                    return true;
                else
                    return false;
            }
        }
    }

    public function actionRearrange_object()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $objId = $post['id'];
                $top = $post['top'];
                $left = $post['left'];

                $model = \app\models\Objects::find()->where(['id' => $objId])->one();
                $objWidth = $model->object_width;
                $objHeight = $model->object_height;

                $saloon = \app\models\Saloons::find()->where(['id' => $model->saloon_id])->one();
                $saloonWidth = $saloon->saloon_width * 100;
                $saloonHeight = $saloon->saloon_height * 100;

                if ($top > ($saloonHeight - $objHeight))  $top = $saloonHeight - $objHeight;
                if ($left > ($saloonWidth - $objWidth)) $left = $saloonWidth - $objWidth;
                if ($top < -30) $top = -30;
                if ($left < -30) $left = -30;
                $model->object_top = $top;
                $model->object_left = $left;

                if ($model->update())
                    return true;
                else
                    return false;
            }
        }
    }

    // modifications
    public function actionRack_modification()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];
                $width = $post['width'];
                $height = $post['height'];
                $depth = $post['depth'];
                $row = $post['row'];
                $column = $post['column'];
                $rotation = $post['rotation'];

                $rack = \app\models\Racks::find()->where(['id' => $id])->one();
                $rack->rack_width = $width;
                $rack->rack_height = $height;
                $rack->rack_depth = $depth;
                $rack->rack_row = $row;
                $rack->rack_column = $column;
                $rack->rack_rotation = $rotation;

                if ($rack->update())
                    return true;
                else
                    return false;
            }
        }
    }


    public function actionRack_remove()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];

                $rack = \app\models\Racks::find()->where(['id' => $id])->one();
                try {
                    $rack->delete();
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }
        }
    }

    public function actionOdf_modification()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];
                $odfNo = $post['odfNo'];
                $width = $post['width'];
                $height = $post['height'];
                $depth = $post['depth'];
                $row = $post['row'];
                $column = $post['column'];
                $rotation = $post['rotation'];

                $odf = \app\models\Odfs::find()->where(['id' => $id])->one();
                $odf->odf_no = $odfNo;
                $odf->odf_width = $width;
                $odf->odf_height = $height;
                $odf->odf_depth = $depth;
                $odf->odf_row = $row;
                $odf->odf_column = $column;
                $odf->odf_rotation = $rotation;

                if ($odf->update())
                    return true;
                else
                    return false;
            }
        }
    }


    public function actionOdf_remove()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];

                $odf = \app\models\Odfs::find()->where(['id' => $id])->one();
                try {
                    $odf->delete();
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }
        }
    }

    public function actionObject_modification()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];
                $width = $post['width'];
                $height = $post['height'];
                $depth = $post['depth'];
                $rotation = $post['rotation'];

                $object = \app\models\Objects::find()->where(['id' => $id])->one();
                $object->object_width = $width;
                $object->object_height = $height;
                $object->object_depth = $depth;
                $object->object_rotation = $rotation;

                if ($object->update())
                    return true;
                else
                    return false;
            }
        }
    }

    public function actionObject_remove()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];

                $object = \app\models\Objects::find()->where(['id' => $id])->one();
                try {
                    $object->delete();
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }
        }
    }

    public function actionText_object_modification()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];
                $font_size = $post['font_size'];
                $text = $post['text'];
                $rotation = $post['rotation'];

                $object = \app\models\Objects::find()->where(['id' => $id])->one();
                $object->font_size = $font_size;
                $object->text = $text;
                $object->object_rotation = $rotation;

                if ($object->update())
                    return true;
                else
                    return false;
            }
        }
    }

    public function actionAdd_new_object()
    {
        $exchId = -1;
        $exchSite = 0;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["object"];
            $exchSite = $post['exchSite'];
            $saloonId = $post["saloon_id"];
            $model = new \app\models\Objects();
            $model->saloon_id = $saloonId;
            $model->object_template_id = $post["template_id"];
            $model->object_width = $post["width"];
            $model->object_height = $post["height"];
            $model->object_depth = $post["depth"];
            $model->object_top = $post["top"];
            $model->object_left = $post["left"];
            $model->object_rotation = $post["rotation"];
            $model->save();

            $exchId = \app\models\Saloons::find()->select('exchange_id')->where(['id'=>$saloonId])->scalar();
            // $exchId = \app\models\Saloons::findOne($post['saloon_id']);
            // $exchId = $exchId->exchange_id;
            // return $this->redirect(["sitex/exchange", 'id'=>$exchId ]);
        }

        if($exchSite == 0)
            return $this->redirect(["sitex/exchange"]);
        else
            return $this->redirect(["sitex/site?id=".$exchId]);
    }

    public function actionAdd_new_text()
    {
        $exchId = -1;
        $exchSite = 0;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["text"];
            $exchSite = $post['exchSite'];
            $saloonId = $post["saloon_id"];
            $model = new \app\models\Objects();
            $model->saloon_id = $saloonId;
            $model->font_size = $post["font_size"];
            $model->text = $post["text"];
            $model->object_top = $post["top"];
            $model->object_left = $post["left"];
            $model->object_rotation = $post["rotation"];

            if (!empty($post["text"]) && ($post["font_size"] > 7) && ($post["font_size"] < 80) && ($post["top"] > -1) && ($post["left"] > -1))
                $model->save();

            $exchId = \app\models\Saloons::find()->select('exchange_id')->where(['id'=>$saloonId])->scalar();
            // $exchId = \app\models\Saloons::findOne($post['saloon_id']);
            // $exchId = $exchId->exchange_id;
            // return $this->redirect(["sitex/exchange", 'id'=>$exchId ]);
        }

        if($exchSite == 0)
            return $this->redirect(["sitex/exchange"]);
        else
            return $this->redirect(["sitex/site?id=".$exchId]);
    }

    public function actionAdd_new_rack()
    {
        $exchId = -1;
        $exchSite = 0;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["rack"];
            $exchSite = $post['exchSite'];
            $saloonId = $post["saloon_id"];
            $model = new \app\models\Racks();
            $model->saloon_id = $saloonId;
            $model->rack_width = $post["width"];
            $model->rack_height = $post["height"];
            $model->rack_depth = $post["depth"];
            $model->rack_row = $post["row"];
            $model->rack_column = $post["column"];
            $model->rack_rotation = $post["rotation"];

            if (($post["width"] > 5))
                $model->save();

            $exchId = \app\models\Saloons::find()->select('exchange_id')->where(['id'=>$saloonId])->scalar();

        }

        if($exchSite == 0)
            return $this->redirect(["sitex/exchange"]);
        else
            return $this->redirect(["sitex/site?id=".$exchId]);
    }

    public function actionAdd_new_odf()
    {
        $exchId = -1;
        $exchSite = 0;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["odf"];
            $exchSite = $post['exchSite'];
            $saloonId = $post["saloon_id"];
            $model = new \app\models\Odfs();
            $model->saloon_id = $saloonId;
            $model->odf_no = $post["odf_no"];
            $model->pos_count = $post["pos_count"];
            $model->odf_width = $post["width"];
            $model->odf_height = $post["height"];
            $model->odf_depth = $post["depth"];
            $model->odf_row = $post["row"];
            $model->odf_column = $post["column"];
            $model->odf_rotation = $post["rotation"];

            if (($post["width"] > 1))
                $model->save();

            $exchId = \app\models\Saloons::find()->select('exchange_id')->where(['id'=>$saloonId])->scalar();

        }

        if($exchSite == 0)
            return $this->redirect(["sitex/exchange"]);
        else
            return $this->redirect(["sitex/site?id=".$exchId]);
    }

    public function actionRemove_saloon()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $id = $post['id'];
                $saloon = \app\models\Saloons::find()->where(['id' => $id])->one();
                try {
                    $saloon->delete();
                    return true;
                } catch (\Exception $e) {
                    return false;
                }
            }
        }
        return false;
    }

    public function actionAdd_saloon()
    {
        $exchId = -1;
        $exchSite = 0;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["saloon"];
            $model = new \app\models\Saloons();
            $exchId = $post["exchId"];
            $model->exchange_id = $exchId;
            $model->building = $post["building"];
            $model->floor = $post["floor"];
            $model->saloon = $post["saloon"];
            $model->saloon_width = $post["width"];
            $model->saloon_height = $post["height"];
            $exchSite = $post['exchSite'];

            if (($post["exchId"] > -1) && ($post["width"] < 100) && ($post["height"] < 100) && ($post["width"] > 0)  && ($post["height"] > 0))
                $model->save();
        }

        if($exchSite == 0)
            return $this->redirect(["sitex/exchange"]);
        else
            return $this->redirect(["sitex/site?id=".$exchId]);
    }

    public function actionEdit_saloon()
    {
        $exchId = -1;
        $exchSite = 0;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["saloon"];
            $exchSite = $post['exchSite'];
            $id = $post['id'];
            $model = \app\models\Saloons::find()->where(['id' => $id])->one();
            $exchId = $model->exchange_id;
            $model->building = $post["building"];
            $model->floor = $post["floor"];
            $model->saloon = $post["saloon"];
            $model->saloon_width = $post["width"];
            $model->saloon_height = $post["height"];

            if (($post["width"] < 100) && ($post["height"] < 100) && ($post["width"] > 0)  && ($post["height"] > 0))
                $model->update();
        }
        if($exchSite == 0)
            return $this->redirect(["sitex/exchange"]);
        else
            return $this->redirect(["sitex/site?id=".$exchId]);
    }

    public function actionAdd_new_exchange()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["exch"];
            $session = Yii::$app->session;
            $session->open();
            if (isset($session['user'])) {
                $provinceId = $session['user']['province_id'];
                $officeId = $session['user']['office_id'];
                $area = $post['area'];
                $name = $post['name'];
                $abbr = $post['abbr'];
                $type = $post['type'];
                $addr = $post['address'];
                $model = new \app\models\Exchanges();
                $model->province_id = $provinceId;
                $model->office_id = $officeId;
                $model->area = $area;
                $model->name = $name;
                $model->abbr = $abbr;
                $model->type = $type;
                $model->address = $addr;

                if (($provinceId > -1) && ($officeId > -1) && ($area > -1) && (!empty($abbr))  && (!empty($name)) && ($type > -1))
                    $model->save();

                return $this->redirect(['sitex/exchanges', 'area' => $area]);
            }
        }

        return $this->redirect(["main/provinces"]);
    }

    public function actionEdit_exchange()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["exch"];

            $id = $post['id'];
            $area = $post['area'];
            $name = $post['name'];
            $abbr = $post['abbr'];
            $type = $post['type'];
            $addr = $post['address'];
            $model = \app\models\Exchanges::find()->where(['id' => $id])->one();
            $model->area = $area;
            $model->name = $name;
            $model->abbr = $abbr;
            $model->type = $type;
            $model->address = $addr;

            if (($area > -1) && (!empty($abbr))  && (!empty($name)) && ($type > -1))
                $model->update();

            return $this->redirect(['sitex/exchange']);
        }

        return $this->redirect(["main/provinces"]);
    }
    // search in area
    public function actionSearch_site_in_area()
    {
        if (Yii::$app->request->isAjax) {
            $session = Yii::$app->session;
            $session->open();
            $provinceId = -1;
            $officeId = -1;
            $area = -1;
            if (isset($session['area']))
                $area = $session['area'];

            if (isset($session['user'])) {
                $provinceId = $session['user']['province_id'];
                $officeId = $session['user']['office_id'];
                $searchSiteModel = new \app\models\ViewExchangesSearch();
                if (Yii::$app->request->queryParams) {
                    $dataSiteProvider = $searchSiteModel->search(Yii::$app->request->queryParams);
                    $dataSiteProvider->query->andWhere(['type_no' => 3]);
                    $dataSiteProvider->query->andWhere(['area' => $area]);
                } else {
                    $query = \app\models\ViewExchangesSearch::find()->where(["province_id" => $provinceId, 'office_id' => $officeId, 'area' => $area, 'type_no' => 3]);
                    $dataSiteProvider = new ActiveDataProvider(['query' => $query]);
                }
                $dataSiteProvider->pagination->pageSize = 3;
                return $this->renderAjax('modals/search/searchSiteInArea', [
                    'searchSiteModel' => $searchSiteModel,
                    'dataSiteProvider' => $dataSiteProvider,
                ]);
            }
        }
        return "";
    }
    // search in exchange
    public function actionSearch_site_in_exchange()
    {
        if (Yii::$app->request->isAjax) {
            $session = Yii::$app->session;
            $session->open();

            $exchId = -1;
            if(isset($session['exchange']))
                $exchId = $session['exchange']['id'];

            if (isset($session['user'])) {
                $provinceId = $session['user']['province_id'];
                $officeId = $session['user']['office_id'];

                $searchSiteModel = new \app\models\ViewExchangesSearch();
                if (Yii::$app->request->queryParams) {
                    $dataSiteProvider = $searchSiteModel->search(Yii::$app->request->queryParams);
                    $dataSiteProvider->query->andWhere(['mother_id' => $exchId]);
                    $dataSiteProvider->query->andWhere(['type_no' => 3]);
                } else {
                    $query = \app\models\ViewExchangesSearch::find()->where(["province_id" => $provinceId, 'office_id' => $officeId, 'mother_id' => $exchId, 'type_no' => 3]);
                    $dataSiteProvider = new ActiveDataProvider(['query' => $query]);
                }
                $dataSiteProvider->pagination->pageSize = 3;
                return $this->renderAjax('modals/search/searchSiteInExch', [
                    'searchSiteModel' => $searchSiteModel,
                    'dataSiteProvider' => $dataSiteProvider,
                ]);
            }
        }
        return "";
    }

    public function actionRemove_exchange()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post()["exch"];
            $id = $post['id'];
            $model = \app\models\Exchanges::find()->where(['id' => $id])->one();
            try
            {
                $model->delete();
                return $this->redirect(['sitex/exchanges']);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', "Exchange must be EMPTY to be removed");
                return $this->redirect(['sitex/exchange']);
            }
        }


    }

    //sites
    public function actionSites($exchId = -1)
    {
        $session = Yii::$app->session;
        $session->open();
        if ($exchId == -1) {
            if (isset($session['exchange']['id'])) {
                $exchId = $session['exchange']['id'];
            }
        }

        if (($exchId > -1) && (isset($session['user'])))
        {
            if (isset($session['exchange'])) $session->remove('exchange');
            $exch = \app\models\Exchanges::find()->where(['id'=>$exchId])->asArray()->one();
            $session['exchange'] = $exch;
            $exchXY = [];
            $model = \app\models\ViewExchanges::find()->select('id,site_top,site_left')->where(['province_id'=>$session['user']['province_id'], 'office_id'=>$session['user']['office_id'], 'type_no'=>3, 'mother_id'=>$exchId])->orderBy("site_cascade,site_node")->asArray()->all();
            foreach($model as $exch)
            {
                $exchXY[$exch['id']] = ['top'=>$exch['site_top'] , 'left'=>$exch['site_left']];
            }
            $exchXY[$exchId]=['top'=>0 , 'left'=>0];

            //sites info
            // [
            // cascade1=>[ node1=>[id=>'', name='',abbr=>'', uplink_id=>uid, 'uplink_abbr'=>'', address=''], node2=>[]... ],
            // cascade2=>[...]
            // ]
            $model = \app\models\ViewExchanges::find()->where(['province_id'=>$session['user']['province_id'], 'office_id'=>$session['user']['office_id'], 'type_no'=>3, 'mother_id'=>$exchId])->orderBy("site_cascade,site_node")->asArray()->all();
            $sites=[];
            $links=[]; //[ [x1,y1x2,y2], [...]... ]
            $i = 0;
            while ($i < count($model))
            {
                $cascade = $model[$i]['site_cascade'];
                $node = $model[$i]['site_node'];
                $sites[$cascade] = [];
                $siteId = $model[$i]['id'];
                $uplinkId = $model[$i]['uplink_id'];
                $siteLeft = $model[$i]['site_left'];
                $siteTop = $model[$i]['site_top'];
                $sites[$cascade][$node] = ['id'=>$siteId, 'name'=>$model[$i]['name'], 'abbr'=>$model[$i]['abbr'], 'uplink_id'=>$uplinkId, 'uplink_abbr'=>$model[$i]['uplink_abbr'], 'site_top'=>$siteTop,'site_left'=>$siteLeft, 'address'=>$model[$i]['address']];
                $uplinkLeft = $exchXY[$uplinkId]['left'];
                $x1=0; $y1=0; $x2=0;$y2=0;
                //suppose site width and height 120px X 100px
                if($uplinkLeft < $siteLeft)
                {
                    // site left
                    $x1 = $siteLeft;
                    $y1 = $siteTop + 120;
                    //mother right
                    $x2 = $exchXY[$uplinkId]['left'] + 120;
                    $y2 = $exchXY[$uplinkId]['top'] + 120;
                }
                else
                {
                    // site right
                    $x1 = $siteLeft + 120;
                    $y1 = $siteTop + 120;
                    //mother left
                    $x2 = $exchXY[$uplinkId]['left'];
                    $y2 = $exchXY[$uplinkId]['top'] + 120;
                }

                if($uplinkId == $exchId)
                {
                    $x2 = 0;
                    $y2 = $y1;
                }

                $vp = [max([$x2,$x1]), max([$y2,$y1])];//width,height
                $links[$cascade][$model[$i]['id']] = ['viewport'=>$vp, 'points'=>[$x1,$y1,$x2,$y2], 'upId'=>$uplinkId, 'sId'=>$siteId];

                $i++;
                while($i < count($model))
                {
                    if($cascade == $model[$i]['site_cascade'])
                    {
                        $node = $model[$i]['site_node'];
                        $siteId = $model[$i]['id'];
                        $uplinkId = $model[$i]['uplink_id'];
                        $siteLeft = $model[$i]['site_left'];
                        $siteTop = $model[$i]['site_top'];
                        $sites[$cascade][$node] = ['id'=>$siteId, 'name'=>$model[$i]['name'], 'abbr'=>$model[$i]['abbr'], 'uplink_id'=>$uplinkId, 'uplink_abbr'=>$model[$i]['uplink_abbr'], 'site_top'=>$siteTop,'site_left'=>$siteLeft, 'address'=>$model[$i]['address']];
                        $uplinkLeft = $exchXY[$uplinkId]['left'];

                        if($uplinkLeft < $siteLeft)
                        {
                            // site left
                            $x1 = $siteLeft;
                            $y1 = $siteTop + 120;
                            //mother right
                            $x2 = $exchXY[$uplinkId]['left'] + 120;
                            $y2 = $exchXY[$uplinkId]['top'] + 120;
                        }
                        else
                        {
                            //link from right side
                            // site right
                            $x1 = $siteLeft + 120;
                            $y1 = $siteTop + 120;
                            //mother left
                            $x2 = $exchXY[$uplinkId]['left'];
                            $y2 = $exchXY[$uplinkId]['top'] + 120;
                        }

                        if($uplinkId == $exchId)
                        {
                            $x2 = 0;
                            $y2 = $y1;
                        }
                        $vp = [max([$x2,$x1]), max([$y2,$y1])];//width,height
                        $links[$cascade][$model[$i]['id']] = ['viewport'=>$vp, 'points'=>[$x1,$y1,$x2,$y2], 'upId'=>$uplinkId, 'sId'=>$siteId];
                    }
                    else break;

                    $i++;
                }
            }

            $this->layout = "simple";
            return $this->render("sites", ['exchId'=>$exchId, 'sites'=>$sites, 'links'=>$links]);
        }

        return $this->redirect(["main/provinces"]);
    }

    public function actionRearrange_site()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $siteId = $post['id'];
            $top = $post['top'];
            $left = $post['left'];

            $model = \app\models\Exchanges::find()->where(['id' => $siteId])->one();
            if ($top < 0) $top = 0;
            if ($left < 0) $left = 0;
            $model->site_top = $top;
            $model->site_left = $left;

            if ($model->update())
                return true;
            else
                return false;
        }
    }

    public function actionAdd_new_site()
    {
        if(Yii::$app->request->isPost)
        {
            $session = Yii::$app->session;
            $session->open();
            $motherId = $session['exchange']['id'];
            $provinceId = $session['exchange']['province_id'];
            $officeId = $session['exchange']['office_id'];
            $area = $session['exchange']['area'];
            $post = Yii::$app->request->post()['exch'];
            $mother = $post['mother_id'];
            $cascade = $post['site_cascade'];
            $node = $post['site_node'];
            $name = $post['name'];
            $abbr = $post['abbr'];
            $uplink = $post['uplink_id'];
            $address = $post['address'];
            if($motherId == $mother)
            {
                if(($node != 1) && ($mother == $uplink))
                {
                    Yii::$app->session->setFlash('error', "First node of the cascade must be the node valued number 1.");
                    return $this->redirect(['sitex/sites']);
                }
                $model = \app\models\Exchanges::find()->select("site_top,site_left")->where(['id'=>$uplink])->asArray()->one();
                $top = $model['site_top'];
                $left = $model['site_left'] + 200;
                $model = new \app\models\Exchanges();
                $model->province_id = $provinceId;
                $model->office_id = $officeId;
                $model->area = $area;
                $model->name = $name;
                $model->abbr = $abbr;
                $model->type = 3;
                $model->mother_id = $motherId;
                $model->uplink_id = $uplink;
                $model->site_cascade = $cascade;
                $model->site_node = $node;
                $model->site_top = $top;
                $model->site_left = $left;
                $model->address = $address;
                try
                {
                    $model->save();
                    Yii::$app->session->setFlash('success', "The site was added successfully");
                }
                catch (\Exception $e)
                {
                    Yii::$app->session->setFlash('error', "Something went wrong. Check Node number and site abbr.");
                }

            }
            else
            {
                Yii::$app->session->setFlash('error', "You do not have the authority to add site.");
            }

        }

        return $this->redirect(['sitex/sites']);
    }

    public function actionEdit_site()
    {
        if(Yii::$app->request->isAjax)
        {
            $session = Yii::$app->session;
            $session->open();
            $motherId = $session['exchange']['mother_id'];
            $provinceId = $session['exchange']['province_id'];
            $officeId = $session['exchange']['office_id'];
            $post = Yii::$app->request->post();
            $id = $post['id'];
            $node = $post['site_node'];
            $name = $post['name'];
            $abbr = $post['abbr'];
            $uplink = $post['uplink_id'];
            $address = $post['address'];

            $model = \app\models\Exchanges::find()->select("site_top,site_left")->where(['id'=>$uplink])->asArray()->one();
            $y2 = $model['site_top'] +120;
            $x2 = $model['site_left'] +120;
            $model = \app\models\Exchanges::find()->where(['province_id'=>$provinceId, 'office_id'=>$officeId, 'id'=>$id])->one();
            $model->name = $name;
            $model->abbr = $abbr;
            $model->uplink_id = $uplink;
            $model->site_node = $node;
            $model->address = $address;
            try
            {
                $model->update();
                $res = ['res'=>true, 'x2'=>$x2, 'y2'=>$y2];
                $res = json_encode($res);
                return $res;
            }
            catch (\Exception $e)
            {
                $res = ['res'=>false];
                $res = json_encode($res);
                return $res;
            }
        }

        $res = ['res'=>false];
        $res = json_encode($res);
        return $res;
    }

    public function actionRemove_site()
    {
        if(Yii::$app->request->isAjax)
        {
            $session = Yii::$app->session;
            $session->open();
            $province_id = $session['exchange']['province_id'];
            $office_id = $session['exchange']['office_id'];
            $post = Yii::$app->request->post();
            $siteId = $post['id'];
            $model = \app\models\Exchanges::find()->where(['province_id'=>$province_id, 'office_id'=>$office_id, 'id'=>$siteId])->one();
            try
            {
                $model->delete();
                return true;
            }
            catch (\Exception $e)
            {
                return false;
            }
        }

        return false;
    }

    public function actionAdd_new_cascade()
    {
        if(Yii::$app->request->isPost)
        {
            $session = Yii::$app->session;
            $session->open();
            $mother_id = $session['exchange']['id'];
            $province_id = $session['exchange']['province_id'];
            $office_id = $session['exchange']['office_id'];
            $area = $session['exchange']['area'];

            $post = Yii::$app->request->post()['exch'];
            $mother_id2 = $post['mother_id'];
            $name = $post['name'];
            $abbr = $post['abbr'];
            $address = $post['address'];
            if($mother_id == $mother_id2)
            {
                $cascade = \app\models\Exchanges::find()->select("MAX(site_cascade)")->where(['province_id'=>$province_id, 'office_id'=>$office_id, 'mother_id'=>$mother_id])->scalar();
                $cascade = $cascade +1;

                $model = new \app\models\Exchanges();
                $model->province_id = $province_id;
                $model->office_id = $office_id;
                $model->area = $area;
                $model->name = $name;
                $model->abbr = $abbr;
                $model->type = 3;
                $model->mother_id = $mother_id;
                $model->uplink_id = $mother_id;
                $model->site_node = 1;
                $model->site_cascade = $cascade;
                $model->site_top = 100;
                $model->site_left = 100;
                $model->address = $address;

                try
                {
                    $model->save();
                    Yii::$app->session->setFlash('success', 'The site was successfully added.');
                }
                catch (\Exception $e)
                {
                    Yii::$app->session->setFlash('error', 'Something went wrong. Check information provided.');
                }
            }
            else
                Yii::$app->session->setFlash('error', 'You do not have the authority.');
        }

        return $this->redirect(['sitex/sites']);
    }

    public function actionSite($id = -1)
    {
        if($id > -1)
        {
            $session = Yii::$app->session;
            $session->open();
            $mother_id = $session['exchange']['id'];
            $province_id = $session['exchange']['province_id'];
            $office_id = $session['exchange']['office_id'];
            $mother_id2 = \app\models\Exchanges::find()->select('mother_id')->where(['province_id'=>$province_id, 'office_id'=>$office_id, 'id'=>$id])->scalar();
            if($mother_id == $mother_id2)
            {
                //__________________________________
                $viewSaloons = \app\models\ViewSaloons::find()->where(['province_id' => $province_id, 'office_id' => $office_id, 'exchange_id' => $id])->orderBy(['floor' => SORT_DESC])->asArray()->all();
                $viewRacks = \app\models\ViewRacks::find()->where(['province_id' => $province_id, 'office_id' => $office_id, 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC, 'rack_row' => SORT_ASC, 'rack_column' => SORT_ASC])->asArray()->all();
                $viewOdfs = \app\models\ViewOdfs::find()->where(['province_id' => $province_id, 'office_id' => $office_id, 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC, 'odf_no' => SORT_ASC, 'odf_row' => SORT_ASC, 'odf_column' => SORT_ASC])->asArray()->all();
                $viewRackDevs = \app\models\ViewRackdevs::find()->where(['province_id' => $province_id, 'office_id' => $office_id, 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC, 'rack_id' => SORT_ASC, 'rack_row' => SORT_ASC, 'rack_column' => SORT_ASC, 'shelf_no' => SORT_ASC])->asArray()->all();
                $objects = \app\models\ViewObjects::find()->where(['province_id' => $province_id, 'office_id' => $office_id, 'exchange_id' => $id])->orderBy(['saloon_id' => SORT_ASC])->asArray()->all();
                $objects_template = \app\models\ViewExchangeObjectTemplate::find()->where(['province_id' => $province_id, 'office_id' => $office_id, 'exchange_id' => $id])->asArray()->all();
                $definedObjects = \app\models\ObjectsTemplate::find()->select(['id', 'object_name', 'object_icon'])->asArray()->all();
                $objectsTemplate = [];
                foreach ($objects_template as $ot) {
                    $objectsTemplate[$ot['object_template_id']] = ['id' => $ot['object_template_id'], 'name' => $ot['object_name'], 'icon' => $ot['object_icon'], 'template' => $ot['object_template']];
                }
                $siteInfo = \app\models\Exchanges::find()->where(['id'=>$id])->asArray()->one();

                $this->layout = "simple";
                return $this->render("site", ['siteInfo'=>$siteInfo, 'viewSaloons' => $viewSaloons, 'viewRacks' => $viewRacks, 'viewOdfs' => $viewOdfs, 'viewRackDevs' => $viewRackDevs, 'objects' => $objects, 'objectsTemplate' => $objectsTemplate, 'definedObjects' => $definedObjects]);
                //__________________________________
            }
            else
                Yii::$app->session->setFlash('error', 'You do not have the authority.');
        }
        return $this->redirect(['sitex/sites']);
    }



}
