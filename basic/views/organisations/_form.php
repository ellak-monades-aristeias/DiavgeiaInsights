<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Organisations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latinName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizationDomains')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supervisorId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supervisorLabel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odeManagerEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vatNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fekNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fekIssue')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
