<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Decisionsb21 */

$this->title = Yii::t('app', 'Create Decisionsb21');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decisionsb21s'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decisionsb21-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
