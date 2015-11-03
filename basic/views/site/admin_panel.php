<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Organisations;
use app\models\Preferences;
use demogorgorn\ajax\AjaxSubmitButton;

/* @var $this yii\web\View */
/* @var $model app\models\Decisions */
/* @var $form ActiveForm */
require_once(__DIR__ . '/../../vendor/opendata/opendata.php');

$this->title = 'Πίνακας Ελέγχου';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
            <div style="text-align: justify;" class="col-lg-7">
                
        <?php
        // Select Organisations : 
        // 1. Get Data From Preferences
        $currentOrgs = Preferences::getSelectedOrgIds();
        echo Html::beginForm('admnin_panel', 'post', ['class'=>'uk-width-medium-1-1 uk-form uk-form-horizontal']);   
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
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);  
                ?>
                    <br>
            <?php
                AjaxSubmitButton::begin([
                'label' => 'Ανανέωση',
                'ajaxOptions' => [
                    'type'=>'POST',
                    'url'=>'?r=site/updatesettings',
                    /*'cache' => false,*/
                    'success' => new \yii\web\JsExpression('function(html){
                        $("#output").html(html);
                        }'),
                ],
                'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
                ]);
                AjaxSubmitButton::end();
    
        echo Html::endForm();    
        ?>
        <p>
            <div id="output"></div>
        </p>              
        </div>
        <div class="col-lg-5">
            <?php
                AjaxSubmitButton::begin([
                'label' => 'Ενημέρωση Από τη Διαύγεια',
                'ajaxOptions' => [
                    'type'=>'POST',
                    'url'=>'?r=site/refreshdataajax',
                    'beforeSend' => new \yii\web\JsExpression('function (xhr) {
                         $(".wrap").addClass("loading");
                    }'),   
                     'complete' => new \yii\web\JsExpression('function (xhr) {
                         $(".wrap").removeClass("loading");
                    }'),                    
                   /* 'beforeSend' => 'function() {          
                        $("#container").addClass("loading");
                    }',
                    'complete' => 'function() {
                        $("#container").removeClass("loading");
                    }',   */                   
                    /*'cache' => false,*/
                    'success' => new \yii\web\JsExpression('function(html){
                        $("#output_refresh").html(html);
                        }'),
                ],
                'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
                ]);
                AjaxSubmitButton::end();
              
            ?>
            <div id="output_refresh"></div>
                <!-- UPDATE BTN + 2-3 STATISTICS-->
                <?php
                $updateDate = Preferences::getRefreshDate();
                echo '<br><br><label class="control-label">Τελευταία Ενημέρωση: </label>';
                echo '<label class="control-label">'. $updateDate[0] . '</label>';
                ?> 
        </div>
    </div>
