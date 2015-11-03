<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cpv */

$this->title = Yii::t('app', 'Create Cpv');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cpvs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
