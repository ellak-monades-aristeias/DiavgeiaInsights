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

$org = $this->params['Resultsb21afmorgID'];
Yii::$app->view->params['Resultsb21afmorgID'] = $org;
$afm = $this->params['Resultsb21afmorgcpv'];
Yii::$app->view->params['Resultsb21afmorgcpv'] = $afm;
//Yii::$app->view->params['orgID'] = $org;
//$org = 99206915;


$this->title = 'Αποφάσεις για ΑΦΜ σε Οργανισμό';
$this->params['breadcrumbs'][] = $this->title;
$connection = \Yii::$app->db;

?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-9">
            <div style="width:100%">
            <?php 
            $rows = 0;
	    $query = "SELECT dc.ada as ΑΔΑ, dc.subject as ΘΕΜΑ, cpv.cpv_label as CPV, ROUND(sp.amount, 2) as ΠΟΣΟ, dc.issueDate as ΗΜΕΡΟΜΗΝΙΑ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp, cpv
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada AND cpv.uid=sp.cpv AND dc.organizationId=".$org." AND sp.afm LIKE '".$afm."' 
ORDER BY ΗΜΕΡΟΜΗΝΙΑ
";
            
            $model = $connection->createCommand($query);
            $lines = $model->queryAll();
            $label = array();
            $data = array();
            foreach ($lines as $line) {
                $label[] = $line['ΗΜΕΡΟΜΗΝΙΑ'];
                $data[] = $line['ΠΟΣΟ'];
                $rows += 1;                
            }
            
            $label = array_slice($label, 0, 20);
            $data = array_slice($data, 0, 20);
      
            $dataProvider = new SqlDataProvider([
            'sql' => "SELECT dc.ada as ΑΔΑ, dc.subject as ΘΕΜΑ, cpv.cpv_label as CPV, ROUND(sp.amount, 2) as ΠΟΣΟ, dc.issueDate as ΗΜΕΡΟΜΗΝΙΑ
FROM decisions as dc, decisionsb21 as db21, sponsor as sp, cpv
WHERE dc.ada=db21.b21_ada AND sp.sp_ada=dc.ada AND cpv.uid=sp.cpv AND dc.organizationId=".$org." AND sp.afm LIKE '".$afm."' 
",
            'totalCount' => $rows,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'ΠΟΣΟ',
                    'ΑΔΑ',                    
                    'CPV',
                    'ΗΜΕΡΟΜΗΝΙΑ',
                    'ΘΕΜΑ'
                ],
            ],
        ]);
            //$searchModel = app\models\OrganisationsSearch::findAll();

            ?>
            <?= ChartJs::widget([
                'type' => 'Line',
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
                        'heading'=>'ΑΠΟΦΑΣΕΙΣ/ΠΟΣΑ ΓΙΑ ΤΟ ΑΦΜ : '.$afm
                    ]                    
                ]); ?>                
            </div>
        </div>
    </div>
