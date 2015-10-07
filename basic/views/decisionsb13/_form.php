<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb13 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decisionsb13-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'b13_ada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financialYear')->textInput() ?>

    <?= $form->field($model, 'budgettype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entryNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partialead')->textInput() ?>

    <?= $form->field($model, 'recalledExpenseDecision')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relatedPartialADA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amountWithKae_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
