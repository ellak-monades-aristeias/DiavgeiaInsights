<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Decisions */

$this->title = $model->ada;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ada], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ada], [
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
            'ada',
            'protocolNumber',
            'subject',
            'issueDate',
            'decisionTypeId',
            'organizationId',
            'url',
            'submissionTimestamp',
            'status',
            'versionId',
            'documentChecksum',
            'correctedVersionId',
        ],
    ]) ?>

</div>
