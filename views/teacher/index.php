<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
    <form method="get" class="form-inline" action="<?= Url::to(['teacher/search'])?>">
        <select class="form-control" id="select" name="select" >
            <option value="name">Name</option>
            <option value="phone">Phone</option>
        </select>

        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'phone',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
