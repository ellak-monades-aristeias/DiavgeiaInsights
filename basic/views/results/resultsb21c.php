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

$org = $this->params['Resultsb21corgID'];
Yii::$app->view->params['Resultsb21corgID'] = $org;
$cpv = $this->params['Resultsb21ccpv'];
Yii::$app->view->params['Resultsb21ccpv'] = $cpv;
//Yii::$app->view->params['orgID'] = $org;
//$org = 99206915;


$this->title = 'Αποφάσεις ανά Μήνα για CPV για Οργανισμό';
$this->params['breadcrumbs'][] = $this->title;
$connection = \Yii::$app->db;

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-9">
            <div style="width:100%">
            <?php 
            $rows = 0;
	    $query = "SELECT ROUND(SUM(awk.amount), 2) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, ROUND(AVG(awk.amount), 2) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as TIMEORDER, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_ada=dc.ada AND dc.organizationId=".$org." AND cpd.cpd_cpv LIKE '".$cpv."'
GROUP BY YEAR(dc.issueDate), MONTH(dc.issueDate)
ORDER BY YEAR(dc.issueDate), MONTH(dc.issueDate)
";
            
            $model = $connection->createCommand($query);
            $lines = $model->queryAll();
            $label = array();
            $data = array();
            foreach ($lines as $line) {
                $label[] = $line['ΜΗΝΑΣ'];
                $data[] = $line['ΠΟΣΟ'];
                $rows += 1;                
            }
            
            $label = array_slice($label, 0, 20);
            $data = array_slice($data, 0, 20);
      
            $dataProvider = new SqlDataProvider([
            'sql' => "SELECT ROUND(SUM(awk.amount), 2) as ΠΟΣΟ, COUNT(awk.amount) as ΠΛΗΘΟΣ, ROUND(AVG(awk.amount), 2) as ΜΟ, CONCAT(YEAR(dc.issueDate),LPAD(MONTH(dc.issueDate), 2, '0')) as TIMEORDER, CONCAT(MONTHNAME(STR_TO_DATE(MONTH(dc.issueDate), '%m')), ', ', YEAR(dc.issueDate)) as ΜΗΝΑΣ
FROM decisions as dc, decisionsb21 as db21, amountwithkae as awk, cpvperdecisions as cpd
WHERE dc.ada=db21.b21_ada AND awk.awk_ada=dc.ada AND cpd.cpd_ada=dc.ada AND dc.organizationId=".$org." AND cpd.cpd_cpv LIKE '".$cpv."'
GROUP BY YEAR(dc.issueDate), MONTH(dc.issueDate)",
            'totalCount' => $rows,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'ΠΟΣΟ',
                    'ΠΛΗΘΟΣ',
                    'ΜΟ',
                    'Timeorder',
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
                   //'height' => '600px',
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
                        'heading'=>'ΠΟΣΑ ΑΝΑ ΜΗΝΑ ΓΙΑ CPV '.$cpv
                    ]                    
                ]); ?>                
            </div>
        </div>
    </div>
