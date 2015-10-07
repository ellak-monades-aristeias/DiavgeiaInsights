<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb13 */

$this->title = Yii::t('app', 'Create Decisionsb13');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb13s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisionsb13-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
