<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
/*$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (Yii::$app->user->id === $model->user0->id) {
        ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?php
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'website',
            'ph_no',
            'user',
            'description:html',    // description attribute in HTML
            [                      // the owner name of the model
                'label' => 'User Name',
                'value' => $model->user0->name,
            ],
            'address:html',    // description attribute in HTML
            [                      // the owner name of the model
                'label' => 'Category',
                'value' => $model->category0->name,
            ],



        ],
    ]) ?>

</div>
