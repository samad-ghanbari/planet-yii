<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;


class MainController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        $session->open();
        if ((isset($session['user'])) || (Yii::$app->controller->action->id == "login")) {
            return parent::beforeAction($action);
        } else {
            $this->layout = "simple";
            return $this->redirect(["main/provinces"]);
        }
    }

    public function actions()
    {
        return ['error' => ['class' => 'yii\web\ErrorAction']];
    }

    public function actionLogin()
    {
        $model = new \app\models\ViewUsers();
        $this->layout = "login";

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()))
            {
                $model->password = md5($model->password);
                $user = \app\models\ViewUsers::find()->where(["national_id" => $model->national_id, "password" => $model->password])->asArray()->one();
                if (!empty($user))
                {
                    $session = Yii::$app->session;
                    $session->open();

                    if (isset($session['user']))
                        $session->destroy();

                    $user['password'] = "";
                    unset($user['password']);
                    $session['user'] = $user;
                    return $this->redirect(['main/provinces']);
                }

                Yii::$app->session->setFlash('error', "Invalid national ID or Password");

                //$model->national_id=NULL;
                $model->password = NULL;
            }
        }

        $session = Yii::$app->session;
        $session->open();

        if (isset($session['user'])) {
            return $this->redirect(["main/provinces"]);
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionCheck_current_password()
    {
        if(Yii::$app->request->isAjax)
        {
            $id = Yii::$app->request->post()['id'];
            $password = Yii::$app->request->post()['password'];
            $password = md5($password);
            $session = Yii::$app->session;
            $session->open();
            $ids = $session['user']['id'];
            if($id == $ids)
            {
                $model = \app\models\Users::find()->where(['id'=>$id])->asArray()->one();
                if($model['password'] == $password)
                    return true;
            }
        }

        return false;
    }

    public function actionEdit_profile()
    {
        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            $id = $post['user']['id'];
            $cp = $post['current-pass'];
            $cp = md5($cp);
            $name = $post['user']['name'];
            $lastname = $post['user']['lastname'];
            $nid = $post['user']['national_id'];
            $area = $post['user']['default_area'];
            $password = $post['user']['password'];
            $confirm = $post['user']['confirm'];
            $chb = 0;
            if(isset($post['reset-chb']))
               $chb = $post['reset-chb'];

            $session = Yii::$app->session;
            $session->open();
            $ids = $session['user']['id'];
            if($id == $ids)
            {
                $model = \app\models\Users::find()->where(['id'=>$id])->one();
                if($cp == $model->password)
                {
                    if($chb == 1)
                    {
                        if($password == $confirm)
                        {
                            $password  = md5($password);
                            $model->name = $name;
                            $model->lastname = $lastname;
                            $model->national_id = $nid;
                            $model->default_area = $area;
                            $model->password = $password;
                            try
                            {
                                $model->update();
                                if(isset($session['user'])) $session->remove("user");
                                $model = \app\models\ViewUsers::find()->where(['id'=>$id])->asArray()->one();
                                $model['password']="";
                                unset($model['password']);
                                $session['user'] = $model;
                                Yii::$app->session->setFlash("success","Your profile was changed successfully.");

                            }
                            catch (\Exception $e)
                            {
                                Yii::$app->session->setFlash("error","Cannot update your profile.");
                            }
                        }
                        else
                        {
                            //set error flash
                            Yii::$app->session->setFlash("error","Your password and its confirmation area not matched.");
                        }
                    }
                    else
                    {
                        $model->name = $name;
                        $model->lastname = $lastname;
                        $model->national_id = $nid;
                        $model->default_area = $area;
                        try
                        {
                            $model->update();
                            if(isset($session['user'])) $session->remove("user");
                            $model = \app\models\ViewUsers::find()->where(['id'=>$id])->asArray()->one();
                            $model['password']="";
                            unset($model['password']);
                            $session['user'] = $model;
                            Yii::$app->session->setFlash("success","Your profile was changed successfully.");
                        }
                        catch (\Exception $e)
                        {
                            Yii::$app->session->setFlash("error","Cannot update your profile.");
                        }
                    }
                }
                else Yii::$app->session->setFlash("error","Your current password is not correct.");
            }
            else
            {
                Yii::$app->session->setFlash("error","You doesn't have the authority to change the profile.");
            }
        }


        return $this->redirect(["main/provinces"]);
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['user']))
            $session->destroy();

        return $this->redirect(['main/login']);
    }

    public function actionRegex_help()
    {
        $this->layout = "simple";
        return $this->render("regex");
    }

    public function actionRecommendation()
    {
        $this->layout = "simple";
        $session = Yii::$app->session;
        $session->open();
        if(isset($session['user']))
        {
            $userId = $session['user']['id'];
            $query = \app\models\ViewRecommendation::find()->where(["user_id"=>$userId])->orderBy("time_stamp");
            $dataProvider = new ActiveDataProvider(['query' => $query,'pagination' => ['pageSize' => 10]]);
            return $this->render("recommendation", ['dataProvider'=>$dataProvider]);
        }

        return $this->redirect(["main/provinces"]);
    }

    public function actionAdd_recommendation()
    {
        if(Yii::$app->request->isPost)
        {
            $session = Yii::$app->session;
            $session->open();
            if(isset($session['user']))
            {
                $userId = $session['user']['id'];
                $post = Yii::$app->request->post();
                $id = $post['recomm']['user_id'];
                $recomm = $post['recomm']['recomm'];
                if( ($id == $userId) && ($recomm != "") )
                {
                    $model = new \app\models\Recommendation();
                    $model->user_id = $id;
                    $model->recommendation  = $recomm;
                    $model->save();
                }
            }
        }
        return $this->redirect(["main/recommendation"]);
    }

    public function actionProvinces()
    {
        $this->layout = "simple";
        $session = Yii::$app->session;
        $session->open();
        if(isset($session['exchange'])) $session->remove("exchange");
        if (isset($session['user'])) {
            return $this->render("provinces");
        } else
            return $this->redirect(['main/login']);
    }

    public function actionArea($area = -1)
    {
        if(isset($session['exchange'])) $session->remove("exchange");
        if ($area > -1)
            return $this->redirect(["sitex/exchanges", 'area' => $area]);

        return $this->redirect(["main/provinces"]);
    }

    //search in province
    public function actionSearch_in_province()
    {
        if (Yii::$app->request->isAjax) {
            $session = Yii::$app->session;
            $session->open();
            if (isset($session['user'])) {
                $provinceId = $session['user']['province_id'];
                $officeId = $session['user']['office_id'];
                $searchModel = new \app\models\ViewExchangesSearch();
                if (Yii::$app->request->queryParams) {
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->orderBy('area ,mother_abbr ,site_cascade, site_node', 'abbr');
                } else {
                    $query = \app\models\ViewExchangesSearch::find()->where(["province_id" => $provinceId, 'office_id' => $officeId])->orderBy('area ,mother_abbr ,site_cascade, site_node', 'abbr');
                    $dataProvider = new ActiveDataProvider(['query' => $query]);
                }
                $dataProvider->pagination->pageSize = 3;
                return $this->renderAjax('modals/search/searchInProvince', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
        return "";
    }

    public function actionIndex()
    {
        // $this->layout = "main";
        // $session = Yii::$app->session;
        // $session->open();
        // $area = -1;
        // if($session['user']) $area = $session['user']['defaultarea'];

        // $searchModel = new \app\models\ViewInterfacesSearch();
        // if(Yii::$app->request->queryParams)
        // {
        //     if(Yii::$app->request->queryParams['ViewInterfacesSearch']['area'] == "")
        //       {
        //         $query = \app\models\ViewInterfacesSearch::find()->where(["area_no"=>-1]);
        //         $dataProvider = new ActiveDataProvider(['query' => $query]);
        //       }
        //       else
        //         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // }
        // else
        //     {
        //       $query = \app\models\ViewInterfacesSearch::find()->where(["area_no"=>-1]);
        //       $dataProvider = new ActiveDataProvider(['query' => $query]);
        //     }

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

    }
}
