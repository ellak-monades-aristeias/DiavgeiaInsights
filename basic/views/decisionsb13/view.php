<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb13 */

$this->title = $model->b13_ada;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb13s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisionsb13-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->b13_ada], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->b13_ada], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'b13_ada',
            'financialYear',
            'budgettype',
            'entryNumber',
            'partialead',
            'recalledExpenseDecision',
            'amount',
            'currency',
            'relatedPartialADA',
            'documentType',
            'amountWithKae_ID',
        ],
    ]) ?>

</div>
