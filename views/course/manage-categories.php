<?php


use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage categories';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $course->name, 'url' => ['view', 'id' => $course->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="course-manage-categories">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'category_id',
                'value' => 'category.name'
            ],

            [
                'attribute' => 'image',
                'value' => function ($model){
                    return Yii::getAlias('@categoryImgUrl') . '/' . $model->category->image;
                },
                'format' => ['image', ['height' => 200]]
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['delete-category', 'course_id' => $model->course_id, 'category_id' => $model->category_id],
                            ['data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ]
    ]); ?>
</div>