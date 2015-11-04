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

}
