<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courses}}`.
 */
class m210802_173611_create_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'teacher_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-courses-teacher_id',
            'courses',
            'teacher_id'
        );

        $this->addForeignKey(
            'fk-courses-teacher_id',
            'courses',
            'teacher_id',
            'teachers',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%courses}}');
    }
}
