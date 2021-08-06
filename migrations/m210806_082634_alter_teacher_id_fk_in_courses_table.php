<?php

use yii\db\Migration;

/**
 * Class m210806_082634_alter_teacher_id_fk_in_courses_table
 */
class m210806_082634_alter_teacher_id_fk_in_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-courses-teacher_id',
            'courses'
        );

        $this->dropIndex(
            'idx-courses-teacher_id',
            'courses'
        );

        $this->addForeignKey(
            'fk-courses-teacher_id',
            'courses',
            'teacher_id',
            'teachers',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->createIndex(
            'idx-courses-teacher_id',
            'courses',
            'teacher_id',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210806_082634_alter_teacher_id_fk_in_courses_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210806_082634_alter_teacher_id_fk_in_courses_table cannot be reverted.\n";

        return false;
    }
    */
}
