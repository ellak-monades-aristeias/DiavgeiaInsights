<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Decisions */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Decisions',
]) . ' ' . $model->ada;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ada, 'url' => ['view', 'id' => $model->ada]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="decisions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
