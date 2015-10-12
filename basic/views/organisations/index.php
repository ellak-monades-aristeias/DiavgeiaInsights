<?php

use yii\helpers\Html;
use yii\grid\GridView;
use demogorgorn\ajax\AjaxSubmitButton;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrganisationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Organisations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php AjaxSubmitButton::begin([
          'label' => 'Refresh',
          'ajaxOptions' => [
              'type'=>'POST',
              'url'=>'index?r=organisations/refreshdata1',
              /*'cache' => false,*/
              'success' => new \yii\web\JsExpression('function(html){
                  $("#output").html(html);
                  }'),
          ],
          'options' => ['class' => 'btn btn-primary', 'type' => 'submit'],
          ]);
          AjaxSubmitButton::end();
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'label',
            'abbreviation',
            //'latinName',
            'category',
            // 'organizationDomains',
            // 'status',
            // 'supervisorId',
            // 'supervisorLabel',
            'website',
            // 'odeManagerEmail:email',
            // 'vatNumber',
            // 'fekNumber',
            // 'fekIssue',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
