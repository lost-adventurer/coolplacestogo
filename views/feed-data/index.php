<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feed Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feed-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Feed Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'map',
            'location_id',
            //'created',
            //'provider',
            //'link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
