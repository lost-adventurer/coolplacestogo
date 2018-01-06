<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeedData */

$this->title = 'Update Feed Data: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Feed Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feed-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
