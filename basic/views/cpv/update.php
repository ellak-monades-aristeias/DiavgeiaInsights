<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cpv */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cpv',
]) . ' ' . $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpvs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cpv-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
