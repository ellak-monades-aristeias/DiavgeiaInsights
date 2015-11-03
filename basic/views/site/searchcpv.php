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
require_once(__DIR__ . '/../../vendor/opendata/opendata.php');

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
                    'url'=>'?r=site/submitquery',
                    /*'cache' => false,*/
                    'success' => new \yii\web\JsExpression('function(response){
                        $("#output").html(response.search);
                        }'),
                ],
                'options' => ['class' => 'customclass', 'type' => 'submit'],
                ]);
                AjaxSubmitButton::end();
    
        echo Html::endForm();    
        ?>                
        <p>
            <div id="output"></div>
            <a class='my-link'>XYZ</a>
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
            $data = array();
            foreach ($lines as $line) {
                $label[] = $line['ΜΗΝΑΣ'];
                $data[] = $line['ΠΟΣΟ'];
                                
            }
            //$query1 = $form->
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
                'type' => 'Bar',
                'options' => [
                   // 'width' => '600px',
                   // 'height' => '400px',
                ],
                'data' => [
                    'labels' => $label,
                    'datasets' => [
                        [
                            'fillColor' => "rgba(220,220,220,0.5)",
                            'strokeColor' => "rgba(220,220,220,1)",
                            'pointColor' => "rgba(220,220,220,1)",
                            'pointStrokeColor' => "#fff",
                            'data' => $data,
                        ],
                    ]
                ]
            ]);
            ?>
                <hr>
                <?php Pjax::begin(['id'=>'formsection', 'linkSelector'=>'a.my-link']); ?>
                <?= 
                GridView::widget([
                'id' => 'gridview01',
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
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
