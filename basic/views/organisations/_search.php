<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganisationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'abbreviation') ?>

    <?= $form->field($model, 'latinName') ?>

    <?= $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'organizationDomains') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'supervisorId') ?>

    <?php // echo $form->field($model, 'supervisorLabel') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'odeManagerEmail') ?>

    <?php // echo $form->field($model, 'vatNumber') ?>

    <?php // echo $form->field($model, 'fekNumber') ?>

    <?php // echo $form->field($model, 'fekIssue') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
