<?php

/* @var $this yii\web\View */
/* @var $dt_posts ActiveDataProvider */

use yii\data\ActiveDataProvider;

$this->title = 'My Yii Application';
?>
<div class="container">
    <?php try {
        yii\widgets\ListView::widget([
            'dataProvider' => $dt_posts,
            'itemView' => '_company',
            'layout' => '<div class="row">{items}</div><div class="text-center">{pager}</div>',
        ]);
    } catch (Exception $e) {
        var_dump($e);
    }
    ?>
</div>


