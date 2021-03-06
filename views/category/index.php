<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
    <form method="get" class="form-inline" action="<?= Url::to(['category/search'])?>">
        <input class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search" id="search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'image',
                'value' => function ($model){
                                return Yii::getAlias('@categoryImgUrl') . '/' . $model->image;
                            },
                'format' => ['image', ['height' => 200]]
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
