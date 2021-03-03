<?php
/* @var $model app\models\Company */

use yii\helpers\Html;


?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 class="truncate text-center"><?= Html::a($model->name, ['company/view', 'id' => $model->id]) ?></h2>
            <hr>
            <p><?= $model->description ?></p>
            <hr>
            <div class="text-right">
                <span><b>Created By <?= $model->user0->name ?></b></span>
            </div>
        </div>
    </div>
</div>
