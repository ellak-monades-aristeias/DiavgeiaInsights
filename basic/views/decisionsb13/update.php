<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb13 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Decisionsb13',
]) . ' ' . $model->b13_ada;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb13s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->b13_ada, 'url' => ['view', 'id' => $model->b13_ada]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="decisionsb13-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
