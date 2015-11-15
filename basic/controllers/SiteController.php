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

require_once(__DIR__ . '/../vendor/opendata/opendata.php');

class SiteController extends Controller
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
     public function actionSearch()
    {
        return $this->render('search');
    }   
    
      public function actionSearchpie()
    {
        return $this->render('searchpie');
    } 
    
      public function actionSearchcpv()
    {
        return $this->render('searchcpv');
    }   
    
      public function actionManual()
    {
        return $this->render('manual');
    }         
    
    /*00-00*/
    public function actionAdmin_panel()
    {
        $model = new Decisions();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('admin_panel', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdatesettings()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs']))
            return;
        if(!isset($_POST['select_types']) || empty($_POST['select_types']))
            return;
        if(!isset($_POST['select_start_date']) || empty($_POST['select_start_date']))
            return;
        if(!isset($_POST['select_end_date']) || empty($_POST['select_end_date']))
            return;        
        $orgs = $_POST['select_orgs'];
        $types = $_POST['select_types'];
        $startdate = $_POST['select_start_date'];
        $enddate = $_POST['select_end_date'];
        
        $connection = \Yii::$app->db;
        
        // DELETE
        Preferences::deleteAll('pref_name LIKE "organisationID"');
        Preferences::deleteAll('pref_name LIKE "selectedTypes"');
        Preferences::deleteAll('pref_name LIKE "end_date"');
        Preferences::deleteAll('pref_name LIKE "start_date"');
        // UPDATE
        foreach ($orgs as $org) {
            //echo $query. '<br>';
            $connection->createCommand()->insert('preferences', [
                'pref_name' => 'organisationID',
                'pref_value' => $org,
            ])->execute();            
        }
        
        foreach ($types as $type) {
            //echo $query. '<br>';
            $connection->createCommand()->insert('preferences', [
                'pref_name' => 'selectedTypes',
                'pref_value' => $type,
            ])->execute();            
        }
        $connection->createCommand()->insert('preferences', [
                'pref_name' => 'start_date',
                'pref_value' => $startdate,
            ])->execute();            
        
        $connection->createCommand()->insert('preferences', [
                'pref_name' => 'end_date',
                'pref_value' => $enddate,
            ])->execute();            
        
        return 1;
    }
    
    public function actionSubmitquery()
    {
        if(!isset($_POST['select_orgs']) || empty($_POST['select_orgs']))
            return;
        if(!isset($_POST['select_types']) || empty($_POST['select_types']))
            return;
        if(!isset($_POST['select_start_date']) || empty($_POST['select_start_date']))
            return;
        if(!isset($_POST['select_end_date']) || empty($_POST['select_end_date']))
            return;        
        $orgs = $_POST['select_orgs'];
        $types = $_POST['select_types'];
        $startdate = $_POST['select_start_date'];
        $enddate = $_POST['select_end_date'];
        
        $search = "";
        //$search .= print_r($orgs);
        //$search .= print_r($types);
        $search ="SELECT SUM(awk.amount) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, AVG(awk.amount ) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as ΣΕΙΡΑ, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada and dc.organizationId=99206915
GROUP BY MONTH(dc.issueDate), YEAR(dc.issueDate)
ORDER BY YEAR(dc.issueDate), MONTH(dc.issueDate)";
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'search' => $search,
            'code' => 100,
        ];
    }    
    
    public function actionRefreshdata()
    {
        return $this->render('refreshdata');
    }
    
    public function actionRefreshdataajax()
    {
      $currentOrgs = Preferences::getSelectedOrgIds();
      //print_r($currentOrgs);
        $currentTypes = Preferences::getSelectedTypes();
        //print_r($currentTypes);
        $currentDates = Preferences::getSelectedDates();
        //print_r($currentDates);
        
        $pages = 0;
        $b21_counter = 0;
        
        $client = new \OpendataClient();
	$client->setAuth('apiuser_1', 'ApiUser@1');


        foreach ($currentOrgs as $corg) {
            $pages = 0;
            foreach ($currentTypes as $ctype) {
                $string = "/search?org=". $corg . "&type=". $ctype ."&size=500&from_date=". $currentDates[0]. "&to_date=". $currentDates[1] ."&page=". $pages;
                //print ($string);
                $response = $client->getResource($string);
                if ($response->code === 200) {    
                        $unitData = $response->data;
                        $sum = 0.0;
                        $counter = 1;
                        $actual_size = 1;
                        $breakOrg = 0;
                    while ($actual_size != 0) {  
                        foreach ($unitData['decisions'] as $unit) {
                            try{
                                //print_r($unit);

                              Yii::$app->db->createCommand()->insert('decisions', [
                                  'ada' => $unit['ada'],
                                  'protocolNumber' => $unit['protocolNumber'],
                                  'subject' => $unit['subject'],
                                  'issueDate' => gmdate("Y-m-d", $unit['issueDate']/1000),
                                  'decisionTypeId' => $unit['decisionTypeId'],
                                  'organizationId' => $unit['organizationId'],
                                  'submissionTimestamp' => gmdate("Y-m-d", $unit['submissionTimestamp']/1000),
                                  'versionId' => $unit['versionId'],
                                  'status' => $unit['status'],
                                  'url' => $unit['documentUrl'],
                                  'documentChecksum' => $unit['documentChecksum'],
                                  'correctedVersionId' => $unit['correctedVersionId'],
                              ])->execute();
                                $b21_counter++;
                                $orgData = $unit['extraFieldValues']['org'];
                                //foreach ($orgData as $org) {
                                    //print_r($orgData);
                                    if (isset($orgData['enterName']['name']))
                                        $Name = $orgData['enterName']['name'];
                                    else 
                                        $Name = '-';
                                   if (isset($orgData['afmCountry']))
                                        $Country = $orgData['afmCountry'];
                                    else 
                                        $Country = '';                          
                                    Yii::$app->db->createCommand()->insert('decisionsb21', [
                                      'b21_ada' => $unit['ada'],
                                      'afm' => $orgData['afm'],
                                      'afmType' => $orgData['afmType'],
                                      'afmCountry' => $Country,
                                      'enterName' => '1',
                                      'name' => $Name,
                                      //'noVATOrg' => $orgData['versionId'],
                                  ])->execute();
                                //}
                                $sponsorData = $unit['extraFieldValues']['sponsor'];
                                //print_r($sponsorData);
                                foreach ($sponsorData as $sponsor1) {
                                    // Expense Amount DATA
                                    if (!isset($sponsor1['expenseAmount']['kae']))
                                        $kae = null;
                                    else
                                        $kae = $sponsor1['expenseAmount']['kae'];
                                    
                                    if (!isset($sponsor1['expenseAmount']['amount']))
                                        $amount = null;
                                    else
                                        $amount = $sponsor1['expenseAmount']['amount'];                                     
                                    
                             
                                    // Sponsor DATA

                                    if (!isset($sponsor1['sponsorAFMName']['afmType']))
                                        $afmType = null;
                                    else
                                        $afmType = $sponsor1['sponsorAFMName']['afmType']; 

                                    if (!isset($sponsor1['sponsorAFMName']['name']))
                                        $name = null;
                                    else
                                        $name = $sponsor1['sponsorAFMName']['name']; 

                                    if (!isset($sponsor1['sponsorAFMName']['noVATOrg']))
                                        $noVATOrg = null;
                                    else
                                        $noVATOrg = $sponsor1['sponsorAFMName']['noVATOrg']; 
                                    
                                    if (!isset($sponsor1['sponsorAFMName']['afm']))
                                        $afm = null;
                                    else
                                        $afm = $sponsor1['sponsorAFMName']['afm']; 
                                    
                                    // CPV DATA
                                    if (!isset($sponsor1['cpv']))
                                        $cpv = "-";
                                    else
                                        $cpv = $sponsor1['cpv'];

                                    Yii::$app->db->createCommand()->insert('amountwithkae', [
                                        'awk_ada' => $unit['ada'],
                                        'afm' => $afm,
                                        'afmType' => $afmType,
                                        //'afmCountry' => $sponsor1['sponsorAFMName']['afmCountry'],
                                        'enterName' => '1',
                                        'name' => $name,
                                        //'noVATOrg' => $sponsor1['sponsorAFMName']['noVATOrg'],
                                        'kae' => $kae,
                                        'amount' => $amount,
                                        //'kaeCreditRemainder' => $sponsor1['expenseAmount']['kaeCreditRemainder'],
                                        //'kaeBudgetRemainder' => $sponsor1['expenseAmount']['kaeBudgetRemainder'],

                                    ])->execute();
                                    
                                    Yii::$app->db->createCommand()->insert('cpvperdecisions', [
                                            'cpd_ada' => $unit['ada'],
                                            'cpd_cpv' => $cpv,
                                        ])->execute();
                                }

                                $counter++;
                            } catch (Exception $e) {
                                echo 'Caught exception: ',  $e->getMessage(), "\n<br>";
                                $exc = $e->getMessage();
                                //if (strstr($exc, "1062 Duplicate entry") != FALSE){
                                    //$breakOrg = 1;
                                    //break;
                                //}
                                    
                            }
                        }
                        $pages++;
                        $string = "/search?org=". $corg . "&type=". $ctype ."&size=500&from_date=". $currentDates[0]. "&to_date=". $currentDates[1] ."&page=". $pages;
                        $response = $client->getResource($string);
                        $unitData = $response->data;
                        //echo "---" . $unitData['info']['actualSize'];
                        $actual_size = $unitData['info']['actualSize'];  
                        if ($actual_size == NULL)
                            $actualSize = 1;
                        else if ($actual_size == 0)
                            break;
                        
                        unset($unit);
                        unset($orgData);
                        unset($kae);
                        unset($afmType);
                        //unset($cpv);
                        unset($afmType);
                        unset($name);
                        unset($amount);
                        
                        //if ($breakOrg == 1) {
                            //$actualSize = 0;
                           // break;
                        //}
                        
                    }
                } else {
                        echo "Error " . $response->code;
                }      
            }
            
        }
        // Update TimeStamp
        $mysqltime = date ("d-m-Y H:i:s");
        Yii::$app->db->createCommand("DELETE FROM preferences WHERE pref_name LIKE 'lastrefreshdate'")->execute();;
        Yii::$app->db->createCommand("INSERT INTO preferences (pref_name, pref_value) VALUES ('lastrefreshdate','".$mysqltime."')")->execute();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'message' => $b21_counter + ' ΑΠΟΦΑΣΕΙΣ ΤΥΠΟΥ Β.2.1 ΠΡΟΣΤΕΘΗΚΑΝ',
            'code' => $b21_counter,
        ];        
    }
}
