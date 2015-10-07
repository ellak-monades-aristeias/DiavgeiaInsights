<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Decisions */

$this->title = Yii::t('app', 'Create Decisions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
