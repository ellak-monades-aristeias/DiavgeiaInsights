<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use app\models\Organisations;
use app\models\Cpv;
use app\models\Preferences;
use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use yii\data\SqlDataProvider;
use yii\web\JsExpression;


$url = \yii\helpers\Url::to(['cpvlist']);
/* @var $this yii\web\View */
/* @var $model app\models\Decisions */
/* @var $form ActiveForm */

$this->title = 'Αναζήτηση';
$this->params['breadcrumbs'][] = $this->title;
$connection = \Yii::$app->db;

        // Select Organisations : 
        // 1. Get Data From Preferences
        $currentOrgs = Organisations::dropdownSearch();
        // Select Decision Types : 
        // 1. Get Data From Preferences
        $currentTypes = Preferences::getSelectedTypes();
        // Select Date Range: 
        // 1. Get Data From Preferences
        $currentDates = Preferences::getSelectedDates();    
        
        $currentCPV = Cpv::dropdownSearch();
?>

    <h1><?= Html::encode($this->title) ?></h1>
    
    <h1 style="text-align: center;"> Αποφάσεις Β.2.1 - Έγκριση Δαπανών</h1>
    <div class="row">
        <div style="text-align: justify;" class="col-lg-4">
            <h4> Αποφάσεις ανά μήνα για Οργανισμό </h4>
            <?php
            // Form 1 : Decisions per month pew organizations
            echo Html::beginForm('index.php?r=results/resultsb21a', 'post');
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
                echo Html::submitButton('Εμφάνιση')
            ?>    
                    <br>     
            <?php
            echo Html::endForm();    
            ?>                
            <p>

            </p>              

        </div>
         <div style="text-align: justify;" class="col-lg-4">
            <h4> Αποφάσεις ανά CPV για Οργανισμό </h4>
            <?php
            // Form 1 : Decisions per month pew organizations
            echo Html::beginForm('index.php?r=results/resultsb21b', 'post');
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
                echo Html::submitButton('Εμφάνιση')
            ?>    
                    <br>     
            <?php
            echo Html::endForm();    
            ?>                
            <p>

            </p>              

        </div>
        <div style="text-align: justify;" class="col-lg-4">
            <h4> Αποφάσεις ανά Μήνα για CPV και Οργανισμό </h4>
            <?php
            // Form 1 : Decisions per month pew organizations
            echo Html::beginForm('index.php?r=results/resultsb21c', 'post');
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
            echo '<label class="control-label">CPV</label>';
            echo Select2::widget([
                'name' => 'select_cpv',
                //'initValueText' => $cityDesc, // set the initial display text
                'options' => ['placeholder' => 'CPV ...'],
                'language' => 'el',
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'ajax' => [
                        'url' => $url,
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(cpv) { return cpv.text; }'),
                    'templateSelection' => new JsExpression('function (cpv) { return cpv.text; }'),
                ],
            ]);              
            ?>
                    <br>
            <?php
                echo Html::submitButton('Εμφάνιση')
            ?>    
                    <br>     
            <?php
            echo Html::endForm();    
            ?>                
            <p>

            </p>              

        </div>
        

    </div>
    <div class="row">
        <div style="text-align: justify;" class="col-lg-4">
        <h4> Αποφάσεις ανά ΑΦΜ για Οργανισμό </h4>
            <?php
            // Form 1 : Decisions per month pew organizations
            echo Html::beginForm('index.php?r=results/resultsb21afm', 'post');
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
                echo Html::submitButton('Εμφάνιση')
            ?>    
                    <br>     
            <?php
            echo Html::endForm();    
            ?>                
          
        </div>
        <div style="text-align: justify;" class="col-lg-4">
        <h4> Αποφάσεις ανά ΑΦΜ για CPV και Οργανισμό </h4>
            <?php
            // Form 1 : Decisions per month pew organizations
            echo Html::beginForm('index.php?r=results/resultsb21afmforcpv', 'post');
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
            // Get the initial city description
            $cpv = new Cpv();
            //$cityDesc = empty($cpv->cpv_label) ? '' : City::findOne($cpv->cpv_label)->description;

            echo Select2::widget([
                'name' => 'select_cpv',
                //'initValueText' => $cityDesc, // set the initial display text
                'options' => ['placeholder' => 'CPV ...'],
                'language' => 'el',
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'ajax' => [
                        'url' => $url,
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(cpv) { return cpv.text; }'),
                    'templateSelection' => new JsExpression('function (cpv) { return cpv.text; }'),
                ],
            ]);            
                echo Html::submitButton('Εμφάνιση')
            ?>    
                    <br>     
            <?php
            echo Html::endForm();    
            ?>                
          
        </div>
        <div style="text-align: justify;" class="col-lg-4">
        <h4> Αποφάσεις για ΑΦΜ για Οργανισμό </h4>
            <?php
            // Form 1 : Decisions per month pew organizations
            echo Html::beginForm('index.php?r=results/resultsb21afmorg', 'post');
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
            echo Html::textInput("set_afm");
            ?>
                    <br>
            <?php
                echo Html::submitButton('Εμφάνιση')
            ?>    
                    <br>     
            <?php
            echo Html::endForm();    
            ?>                
          
        </div>        
    </div>        
        
    </div>
    
        <p>
            <?php
            $updateDate = Preferences::getRefreshDate();
            echo '<br><br><label class="control-label">Τελευταία Ενημέρωση: </label>';
            echo '<label class="control-label">'. $updateDate[0] . '</label>';
            ?>
        </p>    
