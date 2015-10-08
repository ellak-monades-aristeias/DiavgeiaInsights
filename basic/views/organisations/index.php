<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a(Yii::t('app', 'Create Organisations'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'label',
            'abbreviation',
            'latinName',
            'category',
            // 'organizationDomains',
            // 'status',
            // 'supervisorId',
            // 'supervisorLabel',
            // 'website',
            // 'odeManagerEmail:email',
            // 'vatNumber',
            // 'fekNumber',
            // 'fekIssue',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
