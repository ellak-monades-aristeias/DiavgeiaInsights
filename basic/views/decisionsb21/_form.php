<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb21 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="decisionsb21-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'b13_ada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'afm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'afmType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'afmCountry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enterName')->textInput() ?>

    <?= $form->field($model, 'decisionsB21col')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noVATOrg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentType')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
