<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Decisions;
use app\models\Preferences;
use yii\db\Query;

global $testvar;

class ResultsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionResultsmain()
    {
        return $this->render('resultsmain');
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }    
    
    public function actionResultsb21a()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs'])) {
           $orgID1 = Preferences::findOne (['pref_name' => 'Resultsb21aorgID']);
           $orgID = $orgID1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21aorgID']);
        }
        else
            $orgID = $_POST['select_orgs'];
        Preferences::deleteAll(['pref_name' => 'Resultsb21aorgID']);
        Yii::$app->view->params['Resultsb21aorgID'] = $orgID;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21aorgID';
        $pref->pref_value = $orgID;
        $pref->save();
        return $this->render('resultsb21a');
    }    
    
    public function actionResultsb21b()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs'])) {
           $orgID1 = Preferences::findOne (['pref_name' => 'Resultsb21borgID']);
           $orgID = $orgID1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21borgID']);
        }
        else
            $orgID = $_POST['select_orgs'];
        Preferences::deleteAll(['pref_name' => 'Resultsb21borgID']);
        Yii::$app->view->params['Resultsb21borgID'] = $orgID;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21borgID';
        $pref->pref_value = $orgID;
        $pref->save();
        return $this->render('resultsb21b');
    }      
    
    public function actionResultsb21c()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs'])) {
           $orgID1 = Preferences::findOne (['pref_name' => 'Resultsb21corgID']);
           $orgID = $orgID1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21corgID']);
        }
        else
            $orgID = $_POST['select_orgs'];
        if(!isset($_POST['select_cpv']) || empty($_POST['select_cpv'])) {
           $cpv1 = Preferences::findOne (['pref_name' => 'Resultsb21ccpv']);
           $cpv = $cpv1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21ccpv']);
        }
        else
            $cpv = $_POST['select_cpv'];        
        Preferences::deleteAll(['pref_name' => 'Resultsb21corgID']);
        Yii::$app->view->params['Resultsb21corgID'] = $orgID;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21corgID';
        $pref->pref_value = $orgID;
        $pref->save();
        
        Preferences::deleteAll(['pref_name' => 'Resultsb21ccpv']);
        Yii::$app->view->params['Resultsb21ccpv'] = $cpv;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21ccpv';
        $pref->pref_value = $cpv;
        $pref->save();        
        return $this->render('resultsb21c');
    }      
    
    public function actionResultsb21afm()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs'])) {
           $orgID1 = Preferences::findOne (['pref_name' => 'Resultsb21borgID']);
           $orgID = $orgID1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21afmorgID']);
        }
        else
            $orgID = $_POST['select_orgs'];
        Preferences::deleteAll(['pref_name' => 'Resultsb21afmorgID']);
        Yii::$app->view->params['Resultsb21afmorgID'] = $orgID;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21afmorgID';
        $pref->pref_value = $orgID;
        $pref->save();
        return $this->render('resultsb21afm');
    }    
    
    public function actionResultsb21afmforcpv()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs'])) {
           $orgID1 = Preferences::findOne (['pref_name' => 'Resultsb21afmforcpvID']);
           $orgID = $orgID1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21afmforcpvID']);
        }
        else
            $orgID = $_POST['select_orgs'];
        if(!isset($_POST['select_cpv']) || empty($_POST['select_cpv'])) {
           $cpv1 = Preferences::findOne (['pref_name' => 'Resultsb21afmforcpvcpv']);
           $cpv = $cpv1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21afmforcpvcpv']);
        }
        else
            $cpv = $_POST['select_cpv'];        
        Preferences::deleteAll(['pref_name' => 'Resultsb21afmforcpvID']);
        Yii::$app->view->params['Resultsb21afmforcpvID'] = $orgID;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21afmforcpvID';
        $pref->pref_value = $orgID;
        $pref->save();
        
        Preferences::deleteAll(['pref_name' => 'Resultsb21afmforcpvcpv']);
        Yii::$app->view->params['Resultsb21afmforcpvcpv'] = $cpv;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21afmforcpvcpv';
        $pref->pref_value = $cpv;
        $pref->save();        
        return $this->render('resultsb21afmforcpv');
    }   
    
     public function actionResultsb21afmorg()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs'])) {
           $orgID1 = Preferences::findOne (['pref_name' => 'Resultsb21afmorgID']);
           $orgID = $orgID1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21afmorgID']);
        }
        else
            $orgID = $_POST['select_orgs'];
        if(!isset($_POST['set_afm']) || empty($_POST['set_afm'])) {
           $afm1 = Preferences::findOne (['pref_name' => 'Resultsb21afmorgcpv']);
           $afm = $afm1->pref_value;
           Preferences::deleteAll(['pref_name' => 'Resultsb21afmorgcpv']);
        }
        else
            $afm = $_POST['set_afm'];        
        Preferences::deleteAll(['pref_name' => 'Resultsb21afmorgID']);
        Yii::$app->view->params['Resultsb21afmorgID'] = $orgID;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21afmorgID';
        $pref->pref_value = $orgID;
        $pref->save();
        
        Preferences::deleteAll(['pref_name' => 'Resultsb21afmorgcpv']);
        Yii::$app->view->params['Resultsb21afmorgcpv'] = $afm;
        $pref = new Preferences();
        $pref->pref_name = 'Resultsb21afmorgcpv';
        $pref->pref_value = $afm;
        $pref->save();        
        return $this->render('resultsb21afmorg');
    }
    
    public function actionCpvlist($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('uid as id, cpv_label AS text')
                ->from('cpv')
                ->where(['like', 'cpv_label', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => City::find($id)->name];
        }
        return $out;
    }    

}
