<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 *
 * @property CoursesCategories[] $coursesCategories
 * @property Courses[] $courses
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image'], 'required'],
            [['name', 'image'], 'string', 'max' => 255],
            [['image'], 'unique'],
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
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[CoursesCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getCoursesCategories()
//    {
//        return $this->hasMany(CoursesCategories::className(), ['category_id' => 'id']);
//    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasMany(Courses::className(), ['id' => 'course_id'])->viaTable('courses_categories', ['category_id' => 'id']);
    }
}
