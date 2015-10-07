<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb13Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decisionsb13-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'b13_ada') ?>

    <?= $form->field($model, 'financialYear') ?>

    <?= $form->field($model, 'budgettype') ?>

    <?= $form->field($model, 'entryNumber') ?>

    <?= $form->field($model, 'partialead') ?>

    <?php // echo $form->field($model, 'recalledExpenseDecision') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'relatedPartialADA') ?>

    <?php // echo $form->field($model, 'documentType') ?>

    <?php // echo $form->field($model, 'amountWithKae_ID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
