<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="company-index">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <!--    <p>
        <? /*= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description',
            'website',
            'address',
            //'ph_no',
            //'user',
            //'category',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
