<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//require_once('@vendor/opendata/opendata.php');
require(__DIR__ . '/../../vendor/opendata/opendata.php');

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
    <br>
<?php  
// ΕΚΤΥΠΩΣΗ ΠΛΗΡΟΦΟΡΙΩΝ ΦΟΡΕΑ (UID, ΕΠΩΝΥΜΙΑ, ΜΟΝΑΔΕΣ, ΥΠΟΓΡΑΦΟΝΤΕΣ)
$client = new OpendataClient();
$client->setAuth('apiuser_1', 'ApiUser@1');
$response = $client->getResource('/search?org=99206915&type=Β.2.1&size=100');
echo $response->code;
if ($response->code === 200) {    
    $unitData = $response->data;
	$sum = 0.0;
	$counter = 1;
    
		foreach ($unitData['decisions'] as $unit) {
			print $counter . ") ". $unit['subject'] . ": " . $unit['ada'] . " TYPE : " . $unit['decisionTypeId'] . ": ΗΜΕΡΟΜΗΝΙΑ : ". gmdate("Y-m-d", $unit['submissionTimestamp']/1000). " <a href=\"".  $unit['documentUrl'] . "\">Link</a> <br> \n";
			$kaeData = $unit['extraFieldValues']['sponsor'];
			//print_r($kaeData);
			foreach ($kaeData as $kae) {
				print  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp ΠΡΟΜΗΘΕΥΤΗΣ : ".  $kae['sponsorAFMName']['afm'] . " - " . $kae['sponsorAFMName']['name'] . "<br> \n";
				print  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp ΚΑΕ : " . $kae['cpv'] . " ΠΟΣΟ : " . $kae['expenseAmount']['amount'] . "<br> \n";
				$sum += $kae['expenseAmount']['amount'];
			}	
			$counter++;
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