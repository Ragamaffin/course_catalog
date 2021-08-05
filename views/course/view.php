<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add category', ['add-category', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Manage categories', ['manage-categories', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                    'attribute' => 'teacher_id',
                    'value' => $model->getTeacherName()
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
            ]
        ],
    ]) ?>

</div>
