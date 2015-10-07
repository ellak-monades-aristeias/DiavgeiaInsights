<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb22 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Decisionsb22',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb22s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->b22_ada]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="decisionsb22-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
