<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property int $id
 * @property string $name
 * @property int|null $phone
 *
 * @property Courses[] $courses
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['phone'], 'default', 'value' => null],
            [['name'], 'string', 'max' => 255],
            [['phone'], 'unique'],
            ['phone', 'match',
                'pattern' => '/^\+380(39|67|68|96|97|98|50|66|95|99|63|93)[0-9]{7}$/',
                'message' => 'Phone number must be in ukrainian format (+380**1234567)']
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
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['teacher_id' => 'id']);
    }
}
