<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use app\models\Preferences;
use dosamigos\chartjs\ChartJs;
use kartik\grid\GridView;
use yii\data\SqlDataProvider;
use yii\db\Query;



/* @var $this yii\web\View */
/* @var $model app\models\Decisions */
/* @var $form ActiveForm */

$org = $this->params['Resultsb21aorgID'];
Yii::$app->view->params['Resultsb21aorgID'] = $org;
//Yii::$app->view->params['orgID'] = $org;
//$org = 99206915;

$this->title = 'Αποφάσεις ανά μήνα για Οργανισμό';
$this->params['breadcrumbs'][] = $this->title;
$connection = \Yii::$app->db;

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-9">
            <div style="width:100%">
            <?php 
            $rows = 0;
	    $query = "SELECT ROUND(SUM(sp.amount), 2) as ΠΟΣΟ, COUNT(sp.amount) as ΠΛΗΘΟΣ, ROUND(AVG(sp.amount), 2) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as ΣΕΙΡΑ, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada and dc.organizationId=".$org." 
GROUP BY MONTH(dc.issueDate), YEAR(dc.issueDate)
ORDER BY YEAR(dc.issueDate), MONTH(dc.issueDate)";
            $model = $connection->createCommand($query);
            $lines = $model->queryAll();
            $label = array();
            $data = array();
            foreach ($lines as $line) {
                $label[] = $line['ΜΗΝΑΣ'];
                $data[] = $line['ΠΟΣΟ'];
                $rows += 1;                
            }
            
            $label = array_slice($label, -20, 20);
            $data = array_slice($data, -20, 20);           
            
            $dataProvider = new SqlDataProvider([
            'sql' => "SELECT ROUND(SUM(sp.amount), 2) as ΠΟΣΟ, COUNT(sp.amount) as ΠΛΗΘΟΣ, ROUND(AVG(sp.amount), 2) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as ΣΕΙΡΑ, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada and dc.organizationId=".$org." 
GROUP BY MONTH(dc.issueDate), YEAR(dc.issueDate)",
            'totalCount' => $rows,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'ΣΕΙΡΑ',
                    'ΠΟΣΟ',
                    'ΠΛΗΘΟΣ',
                    'ΜΟ',
                    'ΜΗΝΑΣ'
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
