<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Decisions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decisions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protocolNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issueDate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'decisionTypeId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizationId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'privateData')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'submissionTimestamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'versionId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentChecksum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'correctedVersionId')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
