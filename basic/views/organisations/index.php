<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\models\Organisations;
use yii\widgets\Pjax;
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
        <?php echo Html::beginForm('', 'post', ['class'=>'uk-width-medium-1-1 uk-form uk-form-horizontal']); ?>
        <?= Select2::widget([
            'name' => 'country_code',
            'data' => Organisations::dropdown(),
            'options' => [
                'id' => 'country_select',
                'multiple' => false, 
                'placeholder' => 'Choose...',
                'class' => 'uk-width-medium-7-10']
             ]);
        ?>
        <?php AjaxSubmitButton::begin([
          'label' => 'Refresh',
          'ajaxOptions' => [
              'type'=>'POST',
              'url'=>'index.php?r=organisations/refreshdata1',
              /*'cache' => false,*/
              'success' => new \yii\web\JsExpression('function(html){
                  $("#output").html(html);
                  }'),
          ],
          'options' => ['class' => 'btn btn-primary', 'type' => 'submit'],
          ]);
          AjaxSubmitButton::end();
        ?>
        <?php echo Html::endForm(); ?>
    </p>
    <div id="output"></div>
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
