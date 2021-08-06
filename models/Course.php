<?php

namespace app\models;

use Yii;

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
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'id']],
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
        return implode(', ', $categories);
    }
}
