<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Organisations;
use app\models\Preferences;
use demogorgorn\ajax\AjaxSubmitButton;
use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use yii\data\SqlDataProvider;
use yii\db\Query;


/* @var $this yii\web\View */
/* @var $model app\models\Decisions */
/* @var $form ActiveForm */
//require_once(__DIR__ . '/../../vendor/opendata/opendata.php');

$this->title = 'Αναζήτηση';
$this->params['breadcrumbs'][] = $this->title;
$connection = \Yii::$app->db;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
            <div style="text-align: justify;" class="col-lg-3">
        <?php
        // Select Organisations : 
        // 1. Get Data From Preferences
        $currentOrgs = Organisations::dropdownSearch();
        echo Html::beginForm('searchData', 'post', ['class'=>'search']);
        // 2. Show selected Organisations
        echo '<label class="control-label">Οργανισμοί</label>';
        echo Select2::widget([
            'name' => 'select_orgs',
            'data' => $currentOrgs,
            'value' => '',
            'options' => [
                'placeholder' => 'Οργανισμός...',
                'multiple' => false
            ],
        ]);
        ?>
                <br>
        <?php
            // Select Decision Types : 
            // 1. Get Data From Preferences
            $currentTypes = Preferences::getSelectedTypes();

            // 2. Show selected Types
            echo '<label class="control-label">Τύποι Αποφάσεων</label>';
            echo Select2::widget([
                'name' => 'select_types',
                'data' => $currentTypes,
                'value' => '',
                'options' => [
                    'placeholder' => 'Τύπος Αποφάσης...',
                    'multiple' => true
                ],
            ]);
        ?>    
                <br>     
        <?php
            // Select Date Range: 
            // 1. Get Data From Preferences
            $currentDates = Preferences::getSelectedDates();
            
            echo '<label class="control-label">Επιλογή Ημερομηνιών</label>';
            echo DatePicker::widget([
                'type' => DatePicker::TYPE_RANGE,
                'name' => 'select_start_date',
                'value' => $currentDates[0],
                'name2' => 'select_end_date',
                'value2' => $currentDates[1],
                'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);  
            echo '<br>';
            echo '<label class="control-label">ΑΦΜ...</label><br>';
            echo Html::textInput("setAFM", "", ['id'=>'setAFM']);
        ?>
                <br><br>
            <?php
                AjaxSubmitButton::begin([
                'label' => 'Αναζήτηση',
                'ajaxOptions' => [
                    'type'=>'POST',
                    'url'=>'site/updatesettings',
                    /*'cache' => false,*/
                    'success' => new \yii\web\JsExpression('function(html){
                        $("#output").html(html);
                        }'),
                ],
                'options' => ['class' => 'customclass', 'type' => 'submit'],
                ]);
                AjaxSubmitButton::end();
    
        echo Html::endForm();    
        ?>                
        <p>

        </p>              
            <p>
                <?php
                $updateDate = Preferences::getRefreshDate();
                echo '<br><br><label class="control-label">Τελευταία Ενημέρωση: </label>';
                echo '<label class="control-label">'. $updateDate[0] . '</label>';
                ?>
            </p>
        </div>
        <div class="col-lg-9">
            <div style="width:100%">
            <?php 
	    $query = "SELECT SUM(awk.amount) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, AVG(awk.amount ) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as ΣΕΙΡΑ, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada and dc.organizationId=99206915
GROUP BY MONTH(dc.issueDate), YEAR(dc.issueDate)
ORDER BY YEAR(dc.issueDate), MONTH(dc.issueDate)";
            $model = $connection->createCommand($query);
            $lines = $model->queryAll();
            $label = array();
            $data  = array();
            foreach ($lines as $line) {
                $label[] = $line['ΜΗΝΑΣ'];
                $data [] = "[ 'value' => ".  $line['ΠΟΣΟ']. ",<br> 'label' => '" . $line['ΜΗΝΑΣ'] ."',<br> 'color' => 'rgb(" .  rand(0, 255). ", ".  rand(0, 255). ", ".  rand(0, 255).")'], <br> ";
                                
            }
            //echo $data;
            echo json_encode($data);
            
            $dataProvider = new SqlDataProvider([
            'sql' => "SELECT SUM(awk.amount) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, AVG(awk.amount ) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as ΣΕΙΡΑ, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada and dc.organizationId=99206915
GROUP BY MONTH(dc.issueDate), YEAR(dc.issueDate)",
            'totalCount' => 25,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'ΣΕΙΡΑ',
                    'ΠΟΣΟ',
                    'ΠΛΗΘΟΣ',
                    'ΜΟ',
                ],
            ],
        ]);
            //$searchModel = app\models\OrganisationsSearch::findAll();

            ?>
            <?= ChartJs::widget([
                'type' => 'Pie',
                'options' => [
                   // 'width' => '600px',
                   // 'height' => '400px',
                ],
                'data' => [
 [ 'value' => 55442.349853515625,
'label' => 'March, 2012',
'color' => 'rgb(42, 155, 70)'], 
[ 'value' => 76.68000030517578,
'label' => 'December, 2013',
'color' => 'rgb(102, 178, 116)'], 
[ 'value' => 392.40000915527344,
'label' => 'January, 2014',
'color' => 'rgb(160, 123, 253)'], 
[ 'value' => 4896.4000244140625,
'label' => 'February, 2014',
'color' => 'rgb(139, 42, 202)'], 
[ 'value' => 22640.369285583496,
'label' => 'March, 2014',
'color' => 'rgb(195, 55, 92)'], 
[ 'value' => 23341.93978881836,
'label' => 'April, 2014',
'color' => 'rgb(106, 62, 81)'], 
[ 'value' => 11547.870056152344,
'label' => 'May, 2014',
'color' => 'rgb(45, 243, 35)'], 
[ 'value' => 24215.759998321533,
'label' => 'June, 2014',
'color' => 'rgb(48, 21, 127)'], 
[ 'value' => 15909.88003540039,
'label' => 'July, 2014',
'color' => 'rgb(173, 173, 13)'], 
[ 'value' => 1908.969970703125,
'label' => 'August, 2014',
'color' => 'rgb(163, 145, 31)'], 
[ 'value' => 25065.349796295166,
'label' => 'September, 2014',
'color' => 'rgb(141, 121, 10)'], 
[ 'value' => 20071.410041809082,
'label' => 'October, 2014',
'color' => 'rgb(95, 140, 153)'], 
[ 'value' => 36541.939598083496,
'label' => 'November, 2014',
'color' => 'rgb(205, 197, 130)'], 
[ 'value' => 188290.54085731506,
'label' => 'December, 2014',
'color' => 'rgb(26, 21, 40)'], 
[ 'value' => 609588.8594331741,
'label' => 'January, 2015',
'color' => 'rgb(104, 148, 151)'], 
[ 'value' => 1757221.9784402847,
'label' => 'February, 2015',
'color' => 'rgb(224, 181, 33)'], 
[ 'value' => 2273693.5973677635,
'label' => 'March, 2015',
'color' => 'rgb(141, 198, 98)'], 
[ 'value' => 1813442.117225647,
'label' => 'April, 2015',
'color' => 'rgb(86, 175, 49)'], 
[ 'value' => 964446.4097697735,
'label' => 'May, 2015',
'color' => 'rgb(231, 77, 52)'], 
[ 'value' => 1232082.028182812,
'label' => 'June, 2015',
'color' => 'rgb(250, 59, 158)'], 
[ 'value' => 1152080.2222545147,
'label' => 'July, 2015',
'color' => 'rgb(213, 120, 214)'], 
[ 'value' => 283942.33806324005,
'label' => 'August, 2015',
'color' => 'rgb(96, 201, 132)'], 
[ 'value' => 5571938.102293968,
'label' => 'September, 2015',
'color' => 'rgb(177, 44, 201)'], 
[ 'value' => 1955766.4294872284,
'label' => 'October, 2015',
'color' => 'rgb(117, 68, 25)'],                    
                ]
            ]);
            ?>
                <hr>
                <?= GridView::widget([
                'dataProvider'=> $dataProvider,
                    //'filterModel' => $searchModel,
                    //'columns' => $gridColumns,
                'responsive'=>true,
                'export'=>[
                    'fontAwesome'=>true,
                    'showConfirmAlert'=>false,
                    'target'=>GridView::TARGET_BLANK
                ],                    
                'hover'=>true,
                'pjax'=>true,
                'showPageSummary'=>true,
                'panel'=>[
                        'type'=>'primary',
                        'heading'=>'ΠΟΣΑ ΑΝΑ ΜΗΝΑ'
                    ]                    
                ]); ?>                
                
            </div>
        </div>
    </div>
