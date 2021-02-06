<?php

/* @var $this yii\web\View */

/* @var $dt_posts ActiveDataProvider */

use yii\data\ActiveDataProvider;

$this->title = 'My Yii Application';
?>
<?php
if (!Yii::$app->user->isGuest) {
    ?>
    <div class="container">
        <?= yii\widgets\ListView::widget([
            'dataProvider' => $dt_posts,
            'itemView' => '_company',
            'layout' => '<div class="row">{items}</div><div class="text-center">{pager}</div>',
        ])
        ?>
    </div>
    <?php
}
?>


