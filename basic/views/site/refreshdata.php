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
      print_r($currentOrgs);
        $currentTypes = Preferences::getSelectedTypes();
        print_r($currentTypes);
        $currentDates = Preferences::getSelectedDates();
        print_r($currentDates);
        
        $client = new OpendataClient();
	$client->setAuth('apiuser_1', 'ApiUser@1');
	$string = "/search?org=". $currentOrgs[0] . "&type=". $currentTypes[0] ."&size=500&from_date=". $currentDates[0]. "&page=0";
	print ($string);
        $response = $client->getResource($string);
	if ($response->code === 200) {    
		$unitData = $response->data;
		$sum = 0.0;
		$counter = 1;
		
		foreach ($unitData['decisions'] as $unit) {
                    print_r($unit);
			//print $counter . ") ". $unit['subject'] . ": " . $unit['ada'] . " TYPE : " . $unit['decisionTypeId'] . ": ΗΜΕΡΟΜΗΝΙΑ : ". gmdate("Y-m-d", $unit['submissionTimestamp']/1000). " <a href=\"".  $unit['documentUrl'] . "\">Link</a> <br> \n";
			//$kaeData = $unit['extraFieldValues']['sponsor'];
                        //                      print $counter . ") ". $org['uid'] . ": " . $org['label'] . ": ". $org['abbreviation'] . ": ". $org['latinName'] . ": " . $org['category'] . ": ". $org['status'] . ": " . $org['supervisorId'] . ": " . $org['supervisorLabel'] . ": ". $org['website'] . ": " . $org['odeManagerEmail'] . ": " . $org['vatNumber'] . ": ". $org['fekNumber'] . "<br> \n";
                    //try{
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
                          'url' => $unit['url'],
                          'documentChecksum' => $unit['documentChecksum'],
                          'correctedVersionId' => $unit['correctedVersionId'],
                      ])->execute();

                        $orgData = $unit['extraFieldValues']['org'];
                        //foreach ($orgData as $org) {
                            print_r($orgData);
                            if (isset($orgData['enterName']['name']))
                                $Name = $orgData['enterName']['name'];
                            else 
                                $Name = '-';
                           if (isset($orgData['afmCountry']))
                                $Country = $orgData['afmCountry'];
                            else 
                                $Country = '';                          
                            Yii::$app->db->createCommand()->insert('decisionsb21', [
                              'b13_ada' => $unit['ada'],
                              'afm' => $orgData['afm'],
                              'afmType' => $orgData['afmType'],
                              'afmCountry' => $Country,
                              'enterName' => '1',
                              'name' => $Name,
                              //'noVATOrg' => $orgData['versionId'],
                          ])->execute();
                        //}
                        $sponsorData = $unit['extraFieldValues']['sponsor'];
                        foreach ($sponsorData as $sponsor1) {
                            if (!isset($sponsor1['expenseAmount']['kae']))
                                $kae = null;
                            else
                                $kae = $sponsor1['expenseAmount']['kae'];
                            
                            if (!isset($sponsor1['sponsorAFMName']['afmType']))
                                $afmType = null;
                            else
                                $afmType = $sponsor1['sponsorAFMName']['afmType']; 
                            
                            if (!isset($sponsor1['sponsorAFMName']['name']))
                                $name = null;
                            else
                                $name = $sponsor1['sponsorAFMName']['name']; 
                            
                            if (!isset($sponsor1['expenseAmount']['amount']))
                                $amount = null;
                            else
                                $amount = $sponsor1['expenseAmount']['amount']; 
                            
                            Yii::$app->db->createCommand()->insert('amountwithkae', [
                                'awk_ada' => $unit['ada'],
                                'afm' => $sponsor1['sponsorAFMName']['afm'],
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
			}
			$counter++;
                    //} catch (Exception $e) {
                        //echo 'Caught exception: ',  $e->getMessage(), "\n";
                        //break;
                    //}
		}

		print "<h2> ΣΥΝΟΛΙΚΟ ΠΟΣΟ : " . $sum . "€ </h2>";
	 /*   
		print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Υπογράφοντες:<br>\n";
		foreach ($orgData['signers'] as $signer) {
			print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". $signer['uid'] . ": " . $signer['lastName'] . " " . $signer['firstName'] . "<br>\n";
		}
	  */  
	} else {
		echo "Error " . $response->code;
	}
?>
        </div>
    </div>
