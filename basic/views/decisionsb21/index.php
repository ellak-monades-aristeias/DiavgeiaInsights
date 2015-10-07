<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Decisionsb21Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Decisionsb21s');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisionsb21-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Decisionsb21'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'b13_ada',
            'afm',
            'afmType',
            'afmCountry',
            'enterName',
            // 'decisionsB21col',
            // 'name',
            // 'noVATOrg',
            // 'documentType',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
