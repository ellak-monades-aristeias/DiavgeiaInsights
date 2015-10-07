<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb22Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decisionsb22-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'b22_ada') ?>

    <?= $form->field($model, 'afm') ?>

    <?= $form->field($model, 'afmType') ?>

    <?= $form->field($model, 'afmCountry') ?>

    <?= $form->field($model, 'enterName') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'noVATOrg') ?>

    <?php // echo $form->field($model, 'documentType') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
