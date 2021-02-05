<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanyCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Company Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company',
            'category',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
