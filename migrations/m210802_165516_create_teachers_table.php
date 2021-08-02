<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teachers}}`.
 */
class m210802_165516_create_teachers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%teachers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->integer(12)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%teachers}}');
    }
}
