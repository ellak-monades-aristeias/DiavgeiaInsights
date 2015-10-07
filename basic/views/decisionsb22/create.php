<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb22 */

$this->title = Yii::t('app', 'Create Decisionsb22');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb22s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisionsb22-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
