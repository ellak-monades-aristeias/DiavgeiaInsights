<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DecisionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decisions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ada') ?>

    <?= $form->field($model, 'protocolNumber') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'issueDate') ?>

    <?= $form->field($model, 'decisionTypeId') ?>

    <?php // echo $form->field($model, 'organizationId') ?>

    <?php // echo $form->field($model, 'privateData') ?>

    <?php // echo $form->field($model, 'submissionTimestamp') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'versionId') ?>

    <?php // echo $form->field($model, 'documentChecksum') ?>

    <?php // echo $form->field($model, 'correctedVersionId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
