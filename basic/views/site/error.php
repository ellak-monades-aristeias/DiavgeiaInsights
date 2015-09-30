<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Το παραπάνω σφάλμα συνέβη όσο ο διακομιστής Web επεξεργαζόταν το αίτημά σας.
    </p>
    <p>
        Επικοινωνήστε με το διαχειριστή αν εξακολουθεί να εμφανίζεται το πρόβλημα. Σας ευχαριστούμε.
    </p>

</div>
