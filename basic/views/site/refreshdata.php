<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Organisations;
use app\models\Preferences;

/* @var $this yii\web\View */
/* @var $model app\models\Decisions */
/* @var $form ActiveForm */
require_once(__DIR__ . '/../../vendor/opendata/opendata.php');

$this->title = 'Ενημέρωση';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
            <div style="text-align: justify;" class="col-lg-12">
<?php
      $currentOrgs = Preferences::getSelectedOrgIds();
      //print_r($currentOrgs);
        $currentTypes = Preferences::getSelectedTypes();
        //print_r($currentTypes);
        $currentDates = Preferences::getSelectedDates();
        //print_r($currentDates);
        
        $pages = 0;
        
        
        $client = new OpendataClient();
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
                                    
                                    if (!isset($sponsor1['expenseAmount']['currency']))
                                        $currency = null;
                                    else
                                        $currency = $sponsor1['expenseAmount']['currency'];   
                                    
                             
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
                                    
                                    if (!isset($sponsor1['sponsorAFMName']['afmCountry']))
                                        $afmCountry = null;
                                    else
                                        $afmCountry = $sponsor1['sponsorAFMName']['afmCountry']; 
                                    
                                    if (!isset($sponsor1['sponsorAFMName']['noVATOrg']))
                                        $noVATOrg = null;
                                    else
                                        $noVATOrg = $sponsor1['sponsorAFMName']['noVATOrg']; 
                                    
                                    // CPV DATA
                                    if (!isset($sponsor1['cpv']))
                                        $cpv = "-";
                                    else
                                        $cpv = $sponsor1['cpv'];

                                    Yii::$app->db->createCommand()->insert('sponsor', [
                                        'sp_ada' => $unit['ada'],
                                        'afm' => $afm,
                                        'afmType' => $afmType,
                                        'afmCountry' => $afmCountry,
                                        'enterName' => '1',
                                        'name' => $name,
                                        'noVATOrg' => $noVATOrg,
                                        'kae' => $kae,
                                        'amount' => $amount,
                                        'currency' => $currency,
                                        'cpv' => $cpv
                                        //'kaeCreditRemainder' => $sponsor1['expenseAmount']['kaeCreditRemainder'],
                                        //'kaeBudgetRemainder' => $sponsor1['expenseAmount']['kaeBudgetRemainder'],

                                    ])->execute();
                                    
                                    /*Yii::$app->db->createCommand()->insert('cpvperdecisions', [
                                            'cpd_ada' => $unit['ada'],
                                            'cpd_cpv' => $cpv,
                                        ])->execute();*/
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
                unset($response);
                gc_collect_cycles();
            }
            
        }
        // Update TimeStamp
        $mysqltime = date ("d-m-Y H:i:s");
        Yii::$app->db->createCommand("DELETE FROM preferences WHERE pref_name LIKE 'lastrefreshdate'")->execute();;
        Yii::$app->db->createCommand("INSERT INTO preferences (pref_name, pref_value) VALUES ('lastrefreshdate','".$mysqltime."')")->execute();
   
            

?>
        </div>
    </div>
