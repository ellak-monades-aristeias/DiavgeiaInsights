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
require(__DIR__ . '/../../vendor/opendata/opendata.php');

$this->title = 'Πίνακας Ελέγχου';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
            <div style="text-align: justify;" class="col-lg-5">
        <?php
        // Select Organisations : 
        // 1. Get Data From Preferences
        $currentOrgs = Preferences::getSelectedOrgIds();
        
        // 2. Show selected Organisations
        echo '<label class="control-label">Οργανισμοί</label>';
        echo Select2::widget([
            'name' => 'select_orgs',
            'data' => Organisations::dropdown(),
            'value' => $currentOrgs,
            'options' => [
                'placeholder' => 'Επιλέξτε τους Οργανισμούς που θέλετε ...',
                'multiple' => true
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
                'data' => ['Β.1.3' => 'Β.1.3', 'Β.2.1' => 'Β.2.1', 'Β.2.2' => 'Β.2.2', 'Δ.1' => 'Δ.1', 'Δ.2.1' => 'Δ.2.1', 'Δ.2.2' => 'Δ.2.2'],
                'value' => $currentTypes,
                'options' => [
                    'placeholder' => 'Επιλέξτε τους Τύπους Αποφάσεων που θέλετε ...',
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
                    'format' => 'dd-mm-yyyy'
                ]
            ]);        
        ?>
        <p>
            <?php Pjax::begin(); ?>
            <?= $response = "--" ?> 
            <?= Html::a("Ενημέρωση Δεδομένων", ['site/refreshdata'], ['class' => 'btn btn-lg btn-primary']) ?>
            <h1>It's: <?= $response ?></h1>
            <?php Pjax::end(); ?>
        </p>                
            <p>
                <?php
                $updateDate = Preferences::getRefreshDate();
                echo '<br><br><label class="control-label">Τελευταία Ενημέρωση: </label>';
                echo '<label class="control-label">'. $updateDate[0] . '</label>';
                ?>
            </p>
        </div>
        <div class="col-lg-7">
            <a target="_blank" href="http://diavgeia.gov.gr"><img src="../web/images/diavgeia_all_logo.png"></a>
        </div>
    </div>
