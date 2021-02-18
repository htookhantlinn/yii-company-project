<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $hkl app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ph_no')->textInput(['maxlength' => true]) ?>

   <!-- <?php
/*    $category = new Category;
    $categories = $category->getAllCategories(1);
    $items = ArrayHelper::map($categories, 'id', 'name');
    */?>

    <?php /*echo $form->field($hkl, 'parent_id')->dropDownList($items, ['prompt' => '--None--']); */
 //   $c=new Category();
   // $c->categoryTree1();
    ?>
    'btn btn-success']) ?>-->

    <?= $form->field($model, 'category')->dropDownList(
        ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Category']
    ) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

