<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courses_categories}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%courses}}`
 * - `{{%categories}}`
 */
class m210802_174348_create_junction_table_for_courses_and_categories_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%courses_categories}}', [
            'course_id' => $this->integer(),
            'category_id' => $this->integer(),
            'PRIMARY KEY(course_id, category_id)',
        ]);

        // creates index for column `courses_id`
        $this->createIndex(
            '{{%idx-courses_categories-course_id}}',
            '{{%courses_categories}}',
            'course_id'
        );

        // add foreign key for table `{{%courses}}`
        $this->addForeignKey(
            '{{%fk-courses_categories-course_id}}',
            '{{%courses_categories}}',
            'course_id',
            '{{%courses}}',
            'id',
            'CASCADE'
        );

        // creates index for column `categories_id`
        $this->createIndex(
            '{{%idx-courses_categories-category_id}}',
            '{{%courses_categories}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-courses_categories-category_id}}',
            '{{%courses_categories}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%courses}}`
        $this->dropForeignKey(
            '{{%fk-courses_categories-course_id}}',
            '{{%courses_categories}}'
        );

        // drops index for column `courses_id`
        $this->dropIndex(
            '{{%idx-courses_categories-course_id}}',
            '{{%courses_categories}}'
        );

        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-courses_categories-category_id}}',
            '{{%courses_categories}}'
        );

        // drops index for column `categories_id`
        $this->dropIndex(
            '{{%idx-courses_categories-category_id}}',
            '{{%courses_categories}}'
        );

        $this->dropTable('{{%courses_categories}}');
    }
}
