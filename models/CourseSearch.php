<?php


namespace app\models;
use yii\data\ActiveDataProvider;


class CourseSearch extends Course
{
    public $teacher;
    public $category;

    public function rules()
    {
        return [
            [['teacher', 'category'], 'safe'],
        ];
    }
}