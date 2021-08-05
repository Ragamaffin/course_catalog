<?php

use yii\db\Migration;

/**
 * Class m210805_204251_change_phone_column_type_to_varchar_in_teachers_table
 */
class m210805_204251_change_phone_column_type_to_varchar_in_teachers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('teachers', 'phone', 'varchar(255)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210805_204251_change_phone_column_type_to_varchar_in_teachers_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210805_204251_change_phone_column_type_to_varchar_in_teachers_table cannot be reverted.\n";

        return false;
    }
    */
}
