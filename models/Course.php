<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $name
 * @property int|null $teacher_id
 *
 * @property Teachers $teacher
 * @property CoursesCategories[] $coursesCategories
 * @property Categories[] $categories
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['teacher_id'], 'default', 'value' => null],
            [['teacher_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['teacher_id'], 'exist', 'skipOnError' => false, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'teacher_id' => 'Teacher',
            'category_id' => 'Categories',
        ];
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }

    /**
     * Gets query for [[CoursesCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesCategories()
    {
        return $this->hasMany(CoursesCategories::className(), ['course_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('courses_categories', ['course_id' => 'id']);
    }

    public function getTeacherName()
    {
        if ($this->teacher != NULL){
            return $this->teacher->name;
        } else {
            return 'Преподаватель не выбран';
        }
    }

    public function getCategoriesName(){
        $categories = [];
        foreach ($this->category as $category){
            $categories[] = $category->name;
        }
        if(!empty($categories)){
            return implode(', ', $categories);
        } else {
            return "Категории не выбраны";
        }
    }

    public function getFreeCategories($id){
        $categories = (new \yii\db\Query())
            ->select('categories.*')
            ->from('categories')
            ->leftJoin('courses_categories',
                ['categories.id' => new \yii\db\Expression('courses_categories.category_id'), 'courses_categories.course_id' => $id ])
            ->where(['courses_categories.course_id' => null])
            ->all();

        $categories = ArrayHelper::map($categories, 'id', 'name');
        return $categories;
    }

    public function getFreeTeachers(){
        $teachers = (new \yii\db\Query())
            ->select('teachers.*')
            ->from('teachers')
            ->leftJoin('courses',
                ['teachers.id' => new \yii\db\Expression('courses.teacher_id')])
            ->where(['courses.id' => null])
            ->all();
        $teachers = ArrayHelper::map($teachers, 'id', 'name');
        return $teachers;
    }
}

