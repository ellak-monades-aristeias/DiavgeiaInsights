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
                'data' => $currentCPV,
                'value' => '',
                'options' => [
                    'placeholder' => 'CPV...',
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
        

    </div>
    
        <p>
            <?php
            $updateDate = Preferences::getRefreshDate();
            echo '<br><br><label class="control-label">Τελευταία Ενημέρωση: </label>';
            echo '<label class="control-label">'. $updateDate[0] . '</label>';
            ?>
        </p>    
