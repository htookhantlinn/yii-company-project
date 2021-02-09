<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'globalSearch') ?>

   <!-- <?/*= $form->field($model, 'name') */?>

    <?/*= $form->field($model, 'description') */?>

    <?/*= $form->field($model, 'website') */?>

    <?/*= $form->field($model, 'address') */?>

    <?php /*// echo $form->field($model, 'ph_no') */?>

    <?php /*// echo $form->field($model, 'user') */?>

    --><?php /*// echo $form->field($model, 'category') */?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
