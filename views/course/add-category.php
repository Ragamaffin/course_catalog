<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Add category';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $course->name, 'url' => ['view', 'id' => $course->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="add-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($courseCategory, 'category_id')->dropDownList($categories, ['prompt' => 'Выберите категорию']) ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
