<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Preferences */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Preferences',
]) . ' ' . $model->pref_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preferences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pref_ID, 'url' => ['view', 'id' => $model->pref_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="preferences-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
