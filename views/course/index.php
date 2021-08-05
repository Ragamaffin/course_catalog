<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <form method="get" class="form-inline" action="<?= Url::to(['course/search'])?>">
            <select class="form-control" id="select" name="select" >
<!--                <option value="" selected>Выберите параметр поиска</option>-->
                <option value="courses.name" selected>Name</option>
                <option value="teachers.name">Teacher</option>
                <option value="categories.name">Category</option>
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
            [
                'attribute' => 'teacher_id',
                'value' => 'teacher.name'
            ],

            [
                'attribute' => 'category_id',
                'value' => function($model){
                    $categories = [];
                    foreach ($model->category as $category){
                        $categories[] = $category->name;
                    }
                    return implode(', ', $categories);
                  }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
