<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb21 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Decisionsb21',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb21s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->b13_ada]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="decisionsb21-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
