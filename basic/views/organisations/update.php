<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Organisations */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Organisations',
]) . ' ' . $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organisations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="organisations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
